<script>
    document.addEventListener('DOMContentLoaded', () => {

        // ======= Helpers =======
        const openModal = (modal) => modal.style.display = 'flex';
        const closeModal = (modal) => modal.style.display = 'none';

        // ======= Add Sample Modal =======
        const addModal = document.getElementById('modalForm');
        document.getElementById('openModal')?.addEventListener('click', () => openModal(addModal));
        document.getElementById('closeModal')?.addEventListener('click', () => closeModal(addModal));

        // ======= Edit Sample Modal =======
        const editModal = document.getElementById('editModal');
        const editFields = {
            uuid: document.getElementById('edit_id'),
            seal: document.getElementById('edit_seal'),
            company: document.getElementById('edit_company'),
            species: document.getElementById('edit_species'),
            quantity: document.getElementById('edit_quantity')
        };
        const deleteBtn = document.getElementById('deleteSampleBtn');

        // Abrir modal de edición desde botón en la tabla
        document.querySelectorAll('.edit-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                const tr = btn.closest('tr');
                editFields.uuid.value = tr.dataset.uuid;
                editFields.seal.value = tr.children[0].textContent.trim();
                editFields.company.value = tr.children[1].textContent.trim();
                editFields.species.value = tr.children[2].textContent.trim();
                editFields.quantity.value = tr.children[3].textContent.trim();
                openModal(editModal);
            });
        });

        document.getElementById('closeEditModal')?.addEventListener('click', () => closeModal(editModal));

        // Botón eliminar muestra
        deleteBtn?.addEventListener('click', async () => {
            const uuid = editFields.uuid.value;
            if (!uuid) return alert('No se pudo obtener la muestra.');

            if (!confirm("¿Estás seguro de que querés eliminar la muestra?")) return;

            try {
                const response = await fetch(`/samples/delete/${uuid}`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: '_method=DELETE'
                });
                if (response.ok) {
                    alert('Muestra eliminada correctamente.');
                    closeModal(editModal);
                    location.reload();
                } else {
                    const text = await response.text();
                    alert('Error al eliminar: ' + text);
                }
            } catch (error) {
                console.error('Error en la eliminación:', error);
                alert('Error inesperado. Revisa la consola.');
            }
        });

        // ======= Laboratory Analysis Modal =======
        const labModal = document.getElementById('labModal');
        const labFields = {
            sampleId: document.getElementById('lab_sample_id'),
            germination_power: document.getElementById('lab_germination'),
            purity: document.getElementById('lab_purity'),
            inert: document.getElementById('lab_inert')
        };

        // Abrir modal de laboratorio desde botones en la tabla
        document.querySelectorAll('.lab-analysis-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                const tr = btn.closest('tr');
                labFields.sampleId.value = tr.dataset.uuid;
                labFields.germination_power.value = '';
                labFields.purity.value = '';
                labFields.inert.value = '';
                openModal(labModal);
            });
        });

        document.getElementById('closeLabModal')?.addEventListener('click', () => closeModal(labModal));

        // ======= Options Modal (engranaje) =======
        const optionsModal = document.getElementById('optionsModal');
        const closeOptions = document.getElementById('closeOptionsModal');
        const editOptionBtn = document.getElementById('optionsEditBtn');
        const labOptionBtn = document.getElementById('optionsLabBtn');
        let currentUuid = null;

        document.querySelectorAll('.options-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                const tr = btn.closest('tr');
                currentUuid = tr.dataset.uuid;

                const hasLab = tr.dataset.hasLab === '1';
                labOptionBtn.textContent = hasLab ? 'Editar análisis de laboratorio' : 'Cargar análisis de laboratorio';

                openModal(optionsModal);
            });
        });

        closeOptions?.addEventListener('click', () => closeModal(optionsModal));

        // Abrir modal de edición o laboratorio desde opciones
        editOptionBtn?.addEventListener('click', () => {
            if (!currentUuid) return;
            const tr = document.querySelector(`tr[data-uuid="${currentUuid}"]`);
            editFields.uuid.value = currentUuid;
            editFields.seal.value = tr.children[0].textContent.trim();
            editFields.company.value = tr.children[1].textContent.trim();
            editFields.species.value = tr.children[2].textContent.trim();
            editFields.quantity.value = tr.children[3].textContent.trim();
            closeModal(optionsModal);
            openModal(editModal);
        });

        labOptionBtn?.addEventListener('click', () => {
            if (!currentUuid) return;
            const tr = document.querySelector(`tr[data-uuid="${currentUuid}"]`);
            labFields.sampleId.value = currentUuid;
            labFields.germination_power.value = '';
            labFields.purity.value = '';
            labFields.inert.value = '';
            closeModal(optionsModal);
            openModal(labModal);
        });

        // ======= Submit del formulario de laboratorio (AJAX) =======
        document.getElementById('labForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            const data = new URLSearchParams(new FormData(e.target));
            try {
                const res = await fetch(e.target.action, {
                    method: 'POST',
                    body: data
                });
                if (res.ok) {
                    alert('Análisis guardado correctamente.');
                    closeModal(labModal);
                    location.reload();
                } else {
                    alert('Error al guardar análisis.');
                }
            } catch (err) {
                console.error(err);
                alert('Error inesperado.');
            }
        });

    });
</script>
