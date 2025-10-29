<script>
    document.addEventListener('DOMContentLoaded', () => {

        const openModal = (modal) => modal.style.display = 'flex';
        const closeModal = (modal) => modal.style.display = 'none';

        const addModal = document.getElementById('modalForm');
        document.getElementById('openModal')?.addEventListener('click', () => openModal(addModal));
        document.getElementById('closeModal')?.addEventListener('click', () => closeModal(addModal));

        const editModal = document.getElementById('editModal');
        const editFields = {
            uuid: document.getElementById('edit_id'),
            seal: document.getElementById('edit_seal'),
            company: document.getElementById('edit_company'),
            species: document.getElementById('edit_species'),
            quantity: document.getElementById('edit_quantity')
        };
        const deleteBtn = document.getElementById('deleteSampleBtn');

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

        const labModal = document.getElementById('labModal');
        const labFields = {
            sampleId: document.getElementById('lab_sample_id'),
            germination_power: document.getElementById('lab_germination'),
            purity: document.getElementById('lab_purity'),
            inert: document.getElementById('lab_inert')
        };

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
                labOptionBtn.textContent = hasLab
                    ? 'Ver/Editar análisis de laboratorio'
                    : 'Cargar análisis de laboratorio';

                openModal(optionsModal);
            });
        });

        closeOptions?.addEventListener('click', () => closeModal(optionsModal));

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

        labOptionBtn?.addEventListener('click', async () => {
            if (!currentUuid) return;
            const tr = document.querySelector(`tr[data-uuid="${currentUuid}"]`);
            const hasLab = tr.dataset.hasLab === '1';

            const deleteLabBtn = document.getElementById('deleteLabBtn');
            deleteLabBtn.style.display = hasLab ? '' : 'none';

            labFields.sampleId.value = currentUuid;

            if (hasLab) {
                try {
                    const res = await fetch(`/laboratory-analysis/view/${currentUuid}`);
                    if (res.ok) {
                        const data = await res.json();
                        labFields.germination_power.value = data.germination_power ?? '';
                        labFields.purity.value = data.purity ?? '';
                        labFields.inert.value = data.inert_materials ?? '';
                    } else {
                        console.warn('No se pudo obtener el análisis existente');
                        labFields.germination_power.value = '';
                        labFields.purity.value = '';
                        labFields.inert.value = '';
                    }
                } catch (err) {
                    console.error('Error cargando análisis:', err);
                }
            } else {
                labFields.germination_power.value = '';
                labFields.purity.value = '';
                labFields.inert.value = '';
            }

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

        // ======= Eliminar análisis de laboratorio =======
        const deleteLabBtn = document.getElementById('deleteLabBtn');

        deleteLabBtn?.addEventListener('click', async () => {
            const uuid = labFields.sampleId.value;
            if (!uuid) return alert('No se pudo obtener la muestra asociada.');

            if (!confirm("¿Estás seguro de que querés eliminar este análisis de laboratorio?")) return;

            try {
                const response = await fetch(`/laboratory-analysis/delete/${uuid}`, {
                    method: 'DELETE'
                });

                if (response.ok) {
                    alert('Análisis eliminado correctamente.');
                    closeModal(labModal);
                    location.reload();
                } else {
                    const text = await response.text();
                    alert('Error al eliminar el análisis: ' + text);
                }
            } catch (error) {
                console.error('Error al eliminar análisis:', error);
                alert('Error inesperado al eliminar.');
            }
        });

    });
</script>
