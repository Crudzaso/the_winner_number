<x-layout-app>
    <link rel="stylesheet" href="{{ asset('css/user-profile.css') }}">
    <div class="container-user-profile">
        <section class="info-user-data">
            <h3>Hola, nombre de usuario aa</h3>
            <h3>Roleee</h3>
        </section>
        <section class="form-container">
            <form action="" class="form-user">
                <label for="name">Nombre</label>
                <input type="text" id="name" placeholder="Ingresa tu nombre" required value="">

                <label for="name">Contraseña actual</label>
                <div class="password-container">
                    <input type="password" id="current-password" placeholder="Ingresa tu contraseña" required>
                    <button type="button" class="toggle-password" onclick="togglePassword('current-password')"><i
                            class="bi bi-eye-fill i"></i></button>
                </div>

                <label for="email">Correo electronico</label>
                <input type="email" id="email" placeholder="Ingresa tu correo" required
                    value="">

                <label for="new-password">Nueva contraseña</label>
                <div class="password-container">
                    <input type="password" id="new-password" placeholder="Nueva contraseña" required>
                    <button type="button" class="toggle-password" onclick="togglePassword('new-password')"><i
                            class="bi bi-eye-fill i"></i></button>
                </div>

                <label for="confirm-password">Confirma la contraseña</label>
                <div class="password-container">
                    <input type="password" id="confirm-password" placeholder="Confirmar contraseña" required>
                    <button type="button" class="toggle-password" onclick="togglePassword('confirm-password')"><i
                            class="bi bi-eye-fill i"></i></button>
                </div>

                <button type="submit" class="submit-btn">Actualizar perfil</button>
            </form>
        </section>

        <section class="table-purchased-container">
            <h3 class="main-title-user-view">Tus compras</h3>
            <table class="table table-striped table-dark table-lotteries-purchased">
                <thead>
                    <tr class="">
                        <th scope="col">Resultado</th>
                        <th scope="col">Premio</th>
                        <th scope="col">Fecha de juego</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Numero</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td scope="row ">Por jugar</td>
                        <td>aaaaaaaaaaaa</td>
                        <td>aaaaaaaaaaaaa</td>
                        <td>bbbbbbbbbbbbb</td>
                        <td>2392901 </td>
                    </tr>
                    <tr>
                        <td scope="row ">Por jugar</td>
                        <td>aaaaaaaaaaaa</td>
                        <td>aaaaaaaaaaaaa</td>
                        <td>bbbbbbbbbbbbb</td>
                        <td>2392901 </td>
                    </tr>
                    <tr>
                        <td scope="row ">Por jugar</td>
                        <td>aaaaaaaaaaaa</td>
                        <td>aaaaaaaaaaaaa</td>
                        <td>bbbbbbbbbbbbb</td>
                        <td>2392901 </td>
                    </tr>
                </tbody>
            </table>
        </section>

    </div>
</x-layout-app>
