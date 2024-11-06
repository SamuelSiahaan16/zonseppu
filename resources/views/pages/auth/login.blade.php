<x-auth-layout title="Zonseppu | Login">
    <div class="col-12 col-md-8 col-lg-6 col-xl-5 col-xxl-4 mx-auto">
        <div class="card rounded-4 mb-0 border-top border-4 border-primary border-gradient-1">
            <div class="card-body p-5">
                <img src="{{ asset('helper/img/zonseppu-hr-w.svg') }}" class="mb-4" width="145" alt="">
                <h4 class="fw-bold">Get Started Now</h4>
                <p class="mb-0">Enter your credentials to login your account</p>

                <div class="form-body my-5">
                    <form class="row g-3" id="form_login">
                        <div class="col-12">
                            <label for="inputUsername" class="form-label">Username</label>
                            <input type="email" class="form-control" id="inputUsername" name="username"
                                placeholder="Username">
                        </div>
                        <div class="col-12">
                            <label for="inputChoosePassword" class="form-label">Password</label>
                            <div class="input-group" id="show_hide_password">
                                <input type="password" class="form-control border-end-0" id="inputChoosePassword"
                                    placeholder="Enter Password" name="password">
                                <a href="javascript:;" class="input-group-text bg-transparent"><i
                                        class="bi bi-eye-slash-fill"></i></a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked">
                                <label class="form-check-label" for="flexSwitchCheckChecked">Remember
                                    Me</label>
                            </div>
                        </div>
                        <div class="col-md-6 text-end"> <a href="#">Forgot
                                Password ?</a>
                        </div>
                        <div class="col-12">
                            <div class="d-grid">
                                <button type="button" id="tombol_login" class="btn btn-primary"
                                    onclick="auth_post('#tombol_login','#form_login','{{route('auth.login')}}')">
                                    Login
                                </button>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="text-start">
                                <p class="mb-0">Don't have an account yet? <a href="#">Sign up
                                        here</a>
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-auth-layout>