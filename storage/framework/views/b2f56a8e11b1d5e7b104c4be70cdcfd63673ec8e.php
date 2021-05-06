<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>Document</title>
    <!-- Подключаем Bootstrap, чтобы не работать над дизайном проекта -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div id="app">
        <div class="container mt-5">
            <h1>Список книг нашей библиотеки</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Название</th>
                        <th scope="col">Автор</th>
                        <th scope="col">Наличие</th>
                        <th scope="col">Действия</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="book in books_arr">
                        <th scope="row">1</th>
                        <td>{{ book.title }}</td>
                        <td>{{ book.author }}</td>
                        <td>
                            <button v-if="book.availability == 1" type="button" class="btn btn-outline-primary" v-on:click="changeBookAvailability(book.id)">
                                Доступна
                            </button>
                            <button v-else type="button" class="btn btn-outline-primary" v-on:click="changeBookAvailability(book.id)">
                                Выдана
                            </button>
                        </td>
                        <td>
                            <button type="button" class="btn btn-outline-danger" v-on:click="deleteBook(book.id)">
                                Удалить
                            </button>
                        </td>
                    </tr>

                    <!-- Строка с полями для добавления новой книги -->
                    <tr>
                        <th scope="row">Добавить</th>
                        <td><input type="text" class="form-control" v-model="new_book_title"></td>
                        <td><input type="text" class="form-control" v-model="new_book_author"></td>
                        <td></td>
                        <td>
                            <button type="button" class="btn btn-outline-success" v-on:click="addBook">
                                Добавить
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!--Подключаем axios для выполнения запросов к api -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script>

    <!--Подключаем Vue.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.10/vue.min.js"></script>

    <script>
        let vm = new Vue({
            el: '#app',
            data: {
                books_arr: [],
                new_book_author: '',
                new_book_title: ''
            },
            methods: {
                loadBookList(){
                    axios.get('/book/all')
                        .then((response) => {
                            this.books_arr = response.data;
                        });
                },
                addBook(){
                    axios.defaults.headers.common = {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    };
                    axios.post('book/add', {
                        title: this.new_book_title,
                        author: this.new_book_author
                    }).then((response) => {
                        this.loadBookList();
                    });
                },
                deleteBook(id){
                    axios.get('/book/delete/'  + id)
                        .then((response) => {
                            this.loadBookList();
                        });
                },
                changeBookAvailability(id){
                    axios.get('/book/change_availabilty/'  + id)
                        .then((response) => {
                            this.loadBookList();
                        });
                }
            },
            mounted(){
                // Сразу после загрузки страницы подгружаем список книг и отображаем его
                this.loadBookList();
            }
        });
    </script>
</body>
</html><?php /**PATH /var/www/html/laravel/resources/views/spa.blade.php ENDPATH**/ ?>