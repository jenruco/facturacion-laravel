document.addEventListener("DOMContentLoaded", function () {
    console.log("holaaa");

    const btnAgregar = document.getElementById("btnAgregar");

    if (btnAgregar) {
        btnAgregar.addEventListener("click", function () {
            agregaFila();
        });
    }

    document.addEventListener("input", function (e) {
        if (
            !e.target.classList.contains("cantidad") &&
            !e.target.classList.contains("precio")
        ) {
            return;
        }

        const fila = e.target.closest("tr");
        const cantidad = parseFloat(fila.querySelector(".cantidad").value) || 0;
        const precio = parseFloat(fila.querySelector(".precio").value) || 0;

        const subtotal = cantidad * precio;

        fila.querySelector(".subtotal").value = subtotal.toFixed(2);

        calculaTotales();
    });
});

function calculaTotales() {
    let subtotal = 0;
    document.querySelectorAll(".subtotal").forEach((fila) => {
        subtotal += parseFloat(fila.value) || 0;
    });

    const iva = subtotal * 0.15;
    const total = subtotal + iva;
    console.log(subtotal);
    document.getElementById("subtotal").value = subtotal.toFixed(2);
    document.getElementById("iva").value = iva.toFixed(2);
    document.getElementById("total").value = total.toFixed(2);
}

function agregaFila() {
    const tbody = document.getElementById("detalleFactura");
    const index = tbody.children.length;

    const tr = document.createElement("tr");
    tr.innerHTML = `
        <td>
            <input type="text" name="productos[${index}][producto]" class="form-control" required>
        </td>
        <td>
            <input type="number" step="0.01" name="productos[${index}][cantidad]" class="form-control cantidad" required>
        </td>
        <td>
            <input type="number" step="0.01" name="productos[${index}][precio]" class="form-control precio" required>
        </td>
        <td>
            <input type="number" step="0.01" class="form-control subtotal" readonly>
        </td>
        <td class="text-center">
            <button type="button" class="btn btn-danger btn-sm btnEliminar">X</button>
        </td>
    `;
    tbody.append(tr);
}
