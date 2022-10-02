<template>
    <div class="row">
        <div class="col">
            <div class="row mt-5 justify-content-md-center">
                <div class="alert alert-danger" role="alert" v-if="alertDangerMessage">
                    {{ this.alertDangerMessage }}
                </div>
                <div class="alert alert-success" role="alert" v-if="alertSuccessMessage">
                    {{ this.alertSuccessMessage }}
                </div>
            </div>
            <div class="row mt-5 justify-content-md-center">
                <div class="col col-4">
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center" v-for="user in listUser" :key="user.id">
                            <div class="ms-2 me-auto">
                                {{ user.first_name }} {{ user.last_name }}
                            </div>
                            <button type="submit" class="btn btn-danger" :data-id="user.id" v-on:click="onSubmitUserDeleteForm">Delete</button>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row mt-5 justify-content-md-center">
                <div class="col col-4">
                    <form id="userCreateForm" novalidate>
                        <div class="mb-3">
                            <label for="userInputEmail">Email</label>
                            <input type="email" class="form-control" id="userInputEmail" placeholder="john.doe@gmail.com" v-model="inputEmail" required>
                        </div>
                        <div class="mb-3">
                            <label for="userInputFirstName">First Name</label>
                            <input type="text" class="form-control" id="userInputFirstName" placeholder="John" v-model="inputFirstName" required>
                        </div>
                        <div class="mb-3">
                            <label for="userInputLastName">Last Name</label>
                            <input type="text" class="form-control" id="userInputLastName" placeholder="Doe" v-model="inputLastName" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { getAll, setOne, deleteOne } from '../services/UserService'
    import FormData from 'form-data'

    export default {
        name: 'App',
        data() {
            return {
                alertDangerMessage: '',
                alertSuccessMessage: '',
                inputEmail: '',
                inputFirstName: '',
                inputLastName: '',
                listUser: [],
            };
        },
        methods: {
            writeAlert(pType, pMessage) {
                switch (pType) {
                    case 'danger':
                        this.alertDangerMessage = pMessage;
                        break;
                    case 'success':
                        this.alertSuccessMessage = pMessage;
                        break;
                    default:
                        break;
                }
            },
            resetAlerts() {
                this.alertDangerMessage = '';
                this.alertSuccessMessage = '';
            },
            initUserCreateForm() {
                let form = document.querySelector('#userCreateForm');
        
                form.addEventListener('submit', event => {
                    this.resetAlerts();

                    if (form.checkValidity()) {
                        let params = new FormData();
                        params.append('email', this.inputEmail);
                        params.append('first_name', this.inputFirstName);
                        params.append('last_name', this.inputLastName);
                        
                        this.createUser(params);
                    }
                    
                    form.classList.add('was-validated');
                    
                    event.preventDefault();
                    event.stopPropagation();
                }, false);
            },
            onSubmitUserDeleteForm(event) {
                let elementId = parseInt(event.target.getAttribute('data-id'));

                this.deleteUser(elementId);
            },
            getAllUsers() {
                getAll(1, 10).then(response => {
                    if (null === response) {
                        this.writeAlert('danger', 'Error while fetching users');
                    } else {
                        this.listUser = response;
                    }
                })
            },
            createUser(pParams) {
                setOne(pParams).then(response => {
                    if (null === response) {
                        this.writeAlert('danger', 'Error while creatinb user');
                    } else {
                        this.listUser.push(response);
                        
                        this.writeAlert('success', 'User is successfully created');
                    }
                })
            },
            deleteUser(pId) {
                deleteOne(pId).then(response => {
                    if (null === response) {
                        this.writeAlert('danger', 'Error while deleting user');
                    } else {
                        let elementIndex = this.listUser.map(item => item.id).indexOf(pId);
                        
                        this.listUser.splice(elementIndex, 1);
                        this.writeAlert('success', 'User is successfully deleted');
                    }
                })
            }
        },
        mounted() {
            this.initUserCreateForm();
            this.getAllUsers();
        }
    };
</script>
