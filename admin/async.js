// Main Async Router for AJAX Operations

const API_BASE = 'admin/api/';

const AsyncRouter = {
    // === FILTER OPERATIONS ===

    async filterStudents(formElement = null, page = 1, limit = 50) {
        try {
            const form = formElement || document.getElementById('filter-form');
            const filters = this.collectFilterData(form);

            //console.log('Applying filters:', filters);
            const response = await this.sendRequest('filters/filter_students.php?page=' + page + '&limit=' + limit, 'POST', filters);

            if (response.success) {
                this.renderStudentTable(response.data, false, page, limit);
                this.renderPagination(response.page, response.totalPages, 'AsyncRouter.filterStudents');
                this.saveFiltersToLocalStorage(filters);
                ToastNotification.info(response.message);
            } else {
                ToastNotification.error(response.message || 'Помилка при пошуку студентів');
            }
        } catch (error) {
            console.error('Filter error:', error);
            ToastNotification.error('Помилка при пошуку студентів');
        }
    },


    // async filterOldStudents(formElement = null, page = 1, limit = 50) {
    //     try {
    //         const form = formElement || document.getElementById('filter-form');
    //         const filters = this.collectFilterData(form);

    //         console.log('Applying filters:', filters);
    //         const response = await this.sendRequest('filters/filter_old_students.php?page=' + page + '&limit=' + limit, 'POST', filters);

    //         if (response.success) {
    //             this.renderStudentTable(response.data);
    //             this.renderPagination(response.page, response.totalPages, 'AsyncRouter.filterStudents');
    //             this.saveFiltersToLocalStorage(filters);
    //             ToastNotification.info(response.message);
    //         } else {
    //             ToastNotification.error(response.message || 'Помилка при пошуку студентів');
    //         }
    //     } catch (error) {
    //         console.error('Filter error:', error);
    //         ToastNotification.error('Помилка при пошуку студентів');
    //     }
    // },

    async filterGroups(formElement = null, page = 1, limit = 50) {
        try {
            const form = formElement || document.getElementById('filter-form');
            const filters = this.collectFilterData(form);

            //console.log('Applying filters:', filters);
            const response = await this.sendRequest('filters/filter_groups.php?page=' + page + '&limit=' + limit, 'POST', filters);
            //console.log(response);
            if (response.success) {
                this.renderGroupTable(response.data);
                this.renderPagination(response.page, response.totalPages, 'AsyncRouter.filterGroups');
                this.saveFiltersToLocalStorage(filters);
                ToastNotification.info(response.message);
            } else {
                ToastNotification.error(response.message || 'Помилка при пошуку груп');
            }
        } catch (error) {
            console.error('Filter error:', error);
            ToastNotification.error('Помилка при пошуку груп');
        }
    },

    async filterOldStudents(formElement = null, page = 1, limit = 50) {
        try {
            const form = formElement || document.getElementById('filter-form');
            const filters = this.collectFilterData(form);

           // console.log('Applying filters:', filters);
            const response = await this.sendRequest('filters/filter_old_students.php?page=' + page + '&limit=' + limit, 'POST', filters);

            if (response.success) {
                this.renderStudentTable(response.data, true, page, limit);
                this.renderPagination(response.page, response.totalPages, 'AsyncRouter.filterOldStudents');
                this.saveFiltersToLocalStorage(filters);
                ToastNotification.info(response.message);
            } else {
                ToastNotification.error(response.message || 'Помилка при пошуку студентів');
            }
        } catch (error) {
            console.error('Filter error:', error);
            ToastNotification.error('Помилка при пошуку студентів');
        }
    },

    async filterOldGroups(formElement = null, page = 1, limit = 50) {
        try {
            const form = formElement || document.getElementById('filter-form');
            const filters = this.collectFilterData(form);

           //console.log('Applying filters:', filters);
            const response = await this.sendRequest('filters/filter_old_groups.php?page=' + page + '&limit=' + limit, 'POST', filters);

            if (response.success) {
                this.renderGroupTable(response.data, true);
                this.renderPagination(response.page, response.totalPages, 'AsyncRouter.filterOldGroups');
                this.saveFiltersToLocalStorage(filters);
                ToastNotification.info(response.message);
            } else {
                ToastNotification.error(response.message || 'Помилка при пошуку груп');
            }
        } catch (error) {
            console.error('Filter error:', error);
            ToastNotification.error('Помилка при пошуку груп');
        }
    },

    async filterSpecialties(formElement = null, page = 1, limit = 50) {
        try {
            const form = formElement || document.getElementById('filter-form');
            const filters = this.collectFilterData(form);

            console.log('Applying filters:', filters);
            const response = await this.sendRequest('filters/filter_specialties.php?page=' + page + '&limit=' + limit, 'POST', filters);

            if (response.success) {
                this.renderSpecTable(response.data);
                this.renderPagination(response.page, response.totalPages, 'AsyncRouter.filterSpecialties');
                this.saveFiltersToLocalStorage(filters);
                ToastNotification.info(response.message);
            } else {
                ToastNotification.error(response.message || 'Помилка при пошуку спеціальностей');
            }
        } catch (error) {
            console.error('Filter error:', error);
            ToastNotification.error('Помилка при пошуку спеціальностей');
        }
    },

    // === CRUD OPERATIONS ===

    async addStudent(formElement) {
        try {
            const formData = new FormData(formElement);
            const response = await this.sendRequest('crud/add_student.php', 'POST', Object.fromEntries(formData));

            if (response.success) {
                ToastNotification.success('Студента успішно додано');
                formElement.reset();
                // Reload students list
                this.filterStudents();
            } else {
                if (response.errors) {
                    this.highlightFormErrors(formElement, response.errors);
                }
                ToastNotification.error(response.message || 'Помилка при додаванні студента');
            }
        } catch (error) {
            console.error('Add error:', error);
            ToastNotification.error('Помилка при додаванні студента');
        }
    },

    async editStudent(studentId, formElement) {
        try {
            const formData = new FormData(formElement);
            formData.append('id', studentId);
            const response = await this.sendRequest('crud/edit_student.php', 'POST', Object.fromEntries(formData));

            if (response.success) {
                ToastNotification.success('Студента успішно оновлено');
                // Reload students list
                this.filterStudents();
            } else {
                if (response.errors) {
                    this.highlightFormErrors(formElement, response.errors);
                }
                ToastNotification.error(response.message || 'Помилка при оновленні студента');
            }
        } catch (error) {
            console.error('Edit error:', error);
            ToastNotification.error('Помилка при оновленні студента');
        }
    },

    async deleteStudent(studentId) {
        if (!confirm('Ви впевнені що хочете видалити студента?')) {
            return;
        }

        try {
            const response = await this.sendRequest('crud/delete_student.php', 'POST', { id: studentId });

            if (response.success) {
                ToastNotification.success('Студента успішно видалено');
                this.filterStudents();
            } else {
                ToastNotification.error(response.message || 'Помилка при видаленні студента');
            }
        } catch (error) {
            console.error('Delete error:', error);
            ToastNotification.error('Помилка при видаленні студента');
        }
    },

    async addGroup(formElement) {
        try {
            const formData = new FormData(formElement);
            const response = await this.sendRequest('crud/add_group.php', 'POST', Object.fromEntries(formData));

            if (response.success) {
                ToastNotification.success('Групу успішно додано');
                formElement.reset();
                this.filterGroups();
            } else {
                if (response.errors) {
                    this.highlightFormErrors(formElement, response.errors);
                }
                ToastNotification.error(response.message || 'Помилка при додаванні групи');
            }
        } catch (error) {
            console.error('Add error:', error);
            ToastNotification.error('Помилка при додаванні групи');
        }
    },

    async editGroup(groupId, formElement) {
        try {
            const formData = new FormData(formElement);
            formData.append('id', groupId);

            const response = await this.sendRequest('crud/edit_group.php', 'POST', Object.fromEntries(formData));

            if (response.success) {
                ToastNotification.success('Групу успішно оновлено');
                this.filterGroups();
            } else {
                if (response.errors) {
                    this.highlightFormErrors(formElement, response.errors);
                }
                ToastNotification.error(response.message || 'Помилка при оновленні групи');
            }
        } catch (error) {
            console.error('Edit error:', error);
            ToastNotification.error('Помилка при оновленні групи');
        }
    },

    async deleteGroup(groupId) {
        if (!confirm('Ви впевнені що хочете видалити групу?')) {
            return;
        }

        try {
            const response = await this.sendRequest('crud/delete_group.php', 'POST', { id: groupId });

            if (response.success) {
                ToastNotification.success('Групу успішно видалено');
                this.filterGroups();
            } else {
                ToastNotification.error(response.message || 'Помилка при видаленні групи');
            }
        } catch (error) {
            console.error('Delete error:', error);
            ToastNotification.error('Помилка при видаленні групи');
        }
    },

    async addSpec(formElement) {
        try {
            const formData = new FormData(formElement);
            const response = await this.sendRequest('crud/add_spec.php', 'POST', Object.fromEntries(formData));

            if (response.success) {
                ToastNotification.success('Спеціальність успішно додано');
                formElement.reset();
                this.filterSpecialties();
            } else {
                if (response.errors) {
                    this.highlightFormErrors(formElement, response.errors);
                }
                ToastNotification.error(response.message || 'Помилка при додаванні спеціальності');
            }
        } catch (error) {
            console.error('Add error:', error);
            ToastNotification.error('Помилка при додаванні спеціальності');
        }
    },

    async editSpec(specId, formElement) {
        try {
            const formData = new FormData(formElement);
            formData.append('id', specId);

            const response = await this.sendRequest('crud/edit_spec.php', 'POST', Object.fromEntries(formData));

            if (response.success) {
                ToastNotification.success('Спеціальність успішно оновлено');
                this.filterSpecialties();
            } else {
                if (response.errors) {
                    this.highlightFormErrors(formElement, response.errors);
                }
                ToastNotification.error(response.message || 'Помилка при оновленні спеціальності');
            }
        } catch (error) {
            console.error('Edit error:', error);
            ToastNotification.error('Помилка при оновленні спеціальності');
        }
    },

    async deleteSpec(specId) {
        if (!confirm('Ви впевнені що хочете видалити спеціальність?')) {
            return;
        }

        try {
            const response = await this.sendRequest('crud/delete_spec.php', 'POST', { id: specId });

            if (response.success) {
                ToastNotification.success('Спеціальність успішно видалено');
                this.filterSpecialties();
            } else {
                ToastNotification.error(response.message || 'Помилка при видаленні спеціальності');
            }
        } catch (error) {
            console.error('Delete error:', error);
            ToastNotification.error('Помилка при видаленні спеціальності');
        }
    },

    async addUser(formElement) {
        try {
            const formData = new FormData(formElement);
            const response = await this.sendRequest('crud/add_user.php', 'POST', Object.fromEntries(formData));

            if (response.success) {
                ToastNotification.success('Користувача успішно додано');
                formElement.reset();
                // Load users list if applicable
                if (window.loadUsersList) window.loadUsersList();
            } else {
                if (response.errors) {
                    this.highlightFormErrors(formElement, response.errors);
                }
                ToastNotification.error(response.message || 'Помилка при додаванні користувача');
            }
        } catch (error) {
            console.error('Add error:', error);
            ToastNotification.error('Помилка при додаванні користувача');
        }
    },

    async editUser(userId, formElement) {
        try {
            const formData = new FormData(formElement);
            formData.append('user_id', userId);

            const response = await this.sendRequest('crud/edit_user.php', 'POST', Object.fromEntries(formData));

            if (response.success) {
                ToastNotification.success('Користувача успішно оновлено');
                if (window.loadUsersList) window.loadUsersList();
            } else {
                if (response.errors) {
                    this.highlightFormErrors(formElement, response.errors);
                }
                ToastNotification.error(response.message || 'Помилка при оновленні користувача');
            }
        } catch (error) {
            console.error('Edit error:', error);
            ToastNotification.error('Помилка при оновленні користувача');
        }
    },

    async deleteUser(userId) {
        if (!confirm('Ви впевнені що хочете видалити користувача?')) {
            return;
        }

        try {
            const response = await this.sendRequest('crud/delete_user.php', 'POST', { user_id: userId });

            if (response.success) {
                ToastNotification.success('Користувача успішно видалено');
                if (window.loadUsersList) window.loadUsersList();
            } else {
                ToastNotification.error(response.message || 'Помилка при видаленні користувача');
            }
        } catch (error) {
            console.error('Delete error:', error);
            ToastNotification.error('Помилка при видаленні користувача');
        }
    },

    async deleteOldStudent(studentId) {
        if (!confirm('Ви впевнені що хочете видалити студента?')) {
            return;
        }

        try {
            const response = await this.sendRequest('crud/delete_old_student.php', 'POST', { id: studentId });

            if (response.success) {
                ToastNotification.success('Студента успішно видалено');
                if (window.location.pathname.includes('view_old_student.php')) {
                    window.history.back();
                }
            } else {
                ToastNotification.error(response.message || 'Помилка при видаленні студента');
            }
        } catch (error) {
            console.error('Delete error:', error);
            ToastNotification.error('Помилка при видаленні студента');
        }
    },

    async deleteOldGroup(groupId) {
        if (!confirm('Ви впевнені що хочете видалити групу?')) {
            return;
        }

        try {
            const response = await this.sendRequest('crud/delete_old_group.php', 'POST', { id: groupId });

            if (response.success) {
                ToastNotification.success('Групу успішно видалено');
                if (window.location.pathname.includes('view_old_group.php')) {
                    window.history.back();
                }
            } else {
                ToastNotification.error(response.message || 'Помилка при видаленні групи');
            }
        } catch (error) {
            console.error('Delete error:', error);
            ToastNotification.error('Помилка при видаленні групи');
        }
    },

    // === UTILITY FUNCTIONS ===

    async sendRequest(endpoint, method = 'GET', data = null) {
        const url = new URL(API_BASE + endpoint, window.location.origin);

        let options = {
            method: method,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        };

        if (method === 'POST' && data) {
            // Convert data to FormData for PHP $_POST compatibility
            const formData = new FormData();
            this._flattenData(data, formData);
            options.body = formData;
            // Don't set Content-Type header - browser will set it with boundary
        } else if (method === 'GET' && data) {
            Object.keys(data).forEach(key => {
                if (data[key] !== null && data[key] !== undefined && data[key] !== '') {
                    const value = data[key];
                    if (Array.isArray(value)) {
                        value.forEach(v => {
                            if (v) url.searchParams.append(key + '[]', v);
                        });
                    } else {
                        url.searchParams.append(key, value);
                    }
                }
            });
        }

        const response = await fetch(url, options);

        if (!response.ok) {
            throw new Error(`HTTP Error: ${response.status}`);
        }

        return await response.json();
    },

    _flattenData(obj, formData, prefix = '') {
        Object.keys(obj).forEach(key => {
            const value = obj[key];
            const fullKey = prefix ? `${prefix}[${key}]` : key;

            if (Array.isArray(value)) {
                value.forEach((item, index) => {
                    if (item !== null && item !== undefined && item !== '') {
                        formData.append(`${fullKey}[]`, item);
                    }
                });
            } else if (typeof value === 'object' && value !== null) {
                this._flattenData(value, formData, fullKey);
            } else if (value !== null && value !== undefined && value !== '') {
                formData.append(fullKey, value);
            }
        });
    },

    collectFilterData(formElement) {
        const formData = new FormData(formElement);
        const data = {};

        for (let [key, value] of formData) {
            if (key.endsWith('[]')) {
                const fieldName = key.slice(0, -2);
                if (!data[fieldName]) {
                    data[fieldName] = [];
                }
                if (value) {
                    data[fieldName].push(value);
                }
            } else {
                if (value) {
                    data[key] = value;
                }
            }
        }

        return data;
    },

    saveFiltersToLocalStorage(filters) {
        try {
            localStorage.setItem('studentFilters', JSON.stringify(filters));
        } catch (e) {
            console.warn('Could not save filters to localStorage:', e);
        }
    },

    loadFiltersFromLocalStorage() {
        try {
            const filters = localStorage.getItem('studentFilters');
            return filters ? JSON.parse(filters) : null;
        } catch (e) {
            console.warn('Could not load filters from localStorage:', e);
            return null;
        }
    },

    clearFiltersFromLocalStorage() {
        try {
            localStorage.removeItem('studentFilters');
        } catch (e) {
            console.warn('Could not clear filters from localStorage:', e);
        }
    },

    applyFiltersToForm(form, filters) {
        if (!filters) return;

        Object.keys(filters).forEach(key => {
            const value = filters[key];
            const elements = form.elements[key];

            if (elements) {
                if (Array.isArray(value)) {
                    // Checkboxes
                    Array.from(elements).forEach(el => {
                        el.checked = value.includes(el.value);
                    });
                } else if (elements.type === 'checkbox') {
                    elements.checked = !!value;
                } else if (elements.type === 'radio') {
                    Array.from(elements).forEach(el => {
                        el.checked = el.value === value;
                    });
                } else {
                    elements.value = value;
                }
            }
        });
    },

    renderStudentTable(students, oldFormat = false, page = 1, limit = 50) {
        console.log(page, limit);
       // console.log('Rendering students:', students, 'Old format:', oldFormat);
        const container = document.getElementById('results-table');
        if (!container) return;

        let html = `
            <table class="table table-primary rounded-1 table-striped table-responsive-md fs-3">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Прізвище</th>
                        <th>Ім'я</th>
                        <th>По батькові</th>
                        <th>Група</th>
                        <th>Курс</th>
                        <th>Дії</th>
                    </tr>
                </thead>
                <tbody>
        `;

        students.forEach((student, index) => {
            html += `
                <tr>
                    <td>${index + 1 + (page - 1) * limit}</td>
                    <td>${this.escapeHtml(student.s_pr)}</td>
                    <td>${this.escapeHtml(student.s_im)}</td>
                    <td>${this.escapeHtml(student.s_bat)}</td>
                    <td>${this.escapeHtml(student.s_group)}</td>
                    <td>${this.escapeHtml(student.s_cours)}</td>
                    `;
                    if (oldFormat) {
                         html +=`
                        <td>
                            <a href="view_old_student.php?id_st=${student.s_id}">Перегляд</a>
                        </td>
                                        </tr>`;
                    } else {
                            html +=`
                    <td>
                        <a href="view_student.php?id_st=${student.s_id}">Перегляд</a>
                        <a href="edit_student.php?id_st=${student.s_id}">Змінити</a>
                        <a href="#" onclick="AsyncRouter.deleteStudent(${student.s_id}); return false;">Видалити</a>
                    </td>
                                    </tr>
                        `;
                        }


        });

        html += `
                </tbody>
            </table>
        `;

        container.innerHTML = html;
    },

    renderGroupTable(groups, oldFormat = false) {
        console.log('Rendering groups:', groups, 'Old format:', oldFormat);
        const container = document.getElementById('results-table');
        if (!container) return;

        let html = `
            <table class="table table-primary rounded-1 table-striped table-responsive-md">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Назва групи</th>
                        <th>Курс</th>
                        <th>Дії</th>
                    </tr>
                </thead>
                <tbody>
        `;

        groups.forEach((group, index) => {
            if (oldFormat) {
                const viewLink = group.g_id ? `view_old_group.php?id_group=${group.g_id}` : `view_old_group.php?id_group=${group.g_id}`;
            } else {
                // Support both new and old group formats
                const viewLink = group.g_id ? `view_group.php?id_group=${group.g_id}` : `view_old_group.php?id_group=${group.g_id}`;
                const editLink = group.g_id ? `edit_group.php?id_group=${group.g_id}` : `edit_old_group.php?id_group=${group.g_id}`;
            }
            html += `
                <tr>
                    <td>${index + 1}</td>
                    <td>${this.escapeHtml(group.g_im)}</td>
                    <td>${this.escapeHtml(group.g_course)}</td>
                    <td>
                        <a href="${viewLink}">Перегляд</a>
                        <a href="${editLink}">Змінити</a>
                        <a href="#" onclick="AsyncRouter.deleteGroup(${group.g_id}); return false;">Видалити</a>
                    </td>
                </tr>
            `;
        });

        html += `
                </tbody>
            </table>
        `;

        container.innerHTML = html;
    },

    renderSpecTable(specs) {
        const container = document.getElementById('results-table');
        if (!container) return;

        let html = `
            <table class="table table-primary rounded-1 table-striped table-responsive-md">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Галузь</th>
                        <th>Спеціальність</th>
                        <th>Спеціалізація</th>
                        <th>Дії</th>
                    </tr>
                </thead>
                <tbody>
        `;

        specs.forEach((spec, index) => {
            html += `
                <tr>
                    <td>${index + 1}</td>
                    <td>${this.escapeHtml(spec.im_galuz || '')}</td>
                    <td>${this.escapeHtml(spec.im_spec)}</td>
                    <td>${this.escapeHtml(spec.im_specializ || '')}</td>
                    <td>
                        <a href="#" onclick="AsyncRouter.deleteSpec(${spec.id_sp}); return false;">Видалити</a>
                    </td>
                </tr>
            `;
        });

        html += `
                </tbody>
            </table>
        `;

        container.innerHTML = html;
    },

    renderPagination(currentPage, totalPages, callbackName = 'AsyncRouter.filterStudents') {
        const container = document.getElementById('pagination-container');
        if (!container || totalPages <= 1) {
            if (container) container.innerHTML = '';
            return;
        }

        let html = `
            <nav aria-label="Сторінкова навігація">
                <ul class="pagination justify-content-center">
        `;

        // Previous button
        if (currentPage > 1) {
            html += `<li class="page-item"><a class="page-link" href="#" onclick="${callbackName}(document.getElementById('filter-form'), ${currentPage - 1}, document.getElementById('limit').value); return false;">← Попередня</a></li>`;
        } else {
            html += `<li class="page-item disabled"><span class="page-link">← Попередня</span></li>`;
        }

        // Page numbers
        for (let i = 1; i <= totalPages; i++) {
            const active = i === currentPage ? 'active' : '';
            html += `<li class="page-item ${active}"><a class="page-link" href="#" onclick="${callbackName}(document.getElementById('filter-form'), ${i}, document.getElementById('limit').value); return false;">${i}</a></li>`;
        }

        // Next button
        if (currentPage < totalPages) {
            html += `<li class="page-item"><a class="page-link" href="#" onclick="${callbackName}(document.getElementById('filter-form'), ${currentPage + 1}, document.getElementById('limit').value); return false;">Наступна →</a></li>`;
        } else {
            html += `<li class="page-item disabled"><span class="page-link">Наступна →</span></li>`;
        }

        html += `
                </ul>
            </nav>
        `;

        container.innerHTML = html;
    },

    highlightFormErrors(formElement, errors) {
        // Clear previous error highlights
        formElement.querySelectorAll('.form-control.is-invalid').forEach(el => {
            el.classList.remove('is-invalid');
        });

        // Highlight new errors
        Object.keys(errors).forEach(field => {
            const element = formElement.elements[field];
            if (element) {
                element.classList.add('is-invalid');
            }
        });
    },

    escapeHtml(text) {
        const map = {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;'
        };
        return String(text).replace(/[&<>"']/g, m => map[m]);
    }
};

// Initialize on DOM ready
document.addEventListener('DOMContentLoaded', function () {
    // Load saved filters if on filter page
    const filterForm = document.getElementById('filter-form');
    if (filterForm) {
        const savedFilters = AsyncRouter.loadFiltersFromLocalStorage();
        if (savedFilters) {
            AsyncRouter.applyFiltersToForm(filterForm, savedFilters);
        }
    }
});
