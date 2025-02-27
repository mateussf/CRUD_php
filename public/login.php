<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5" style="max-width: 300px;">
        <h2>Login</h2>
        <form action="#" method="post" id="loginForm">
            <div class="mb-3">
                <label>Email</label>
                <input type="text" name="usuario" class="form-control" required>
                <div class="invalid-feedback">
                    Por favor, insira seu usuário.
                </div>
            </div>
            <div class="mb-3">
                <label>Senha</label>
                <input type="password" name="senha" class="form-control" required>
                <div class="invalid-feedback">
                    Por favor, insira sua senha.
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Entrar</button>
            <div class="alert alert-danger mt-3 d-none" role="alert" id="loginAlert">

            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#loginForm').on('submit', function(event) {
                event.preventDefault();
                event.stopPropagation();

                var form = this;
                if (form.checkValidity() === false) {
                    form.classList.add('was-validated');
                    return;
                }

                $.ajax({
                    url: '/login/login.php',
                    method: 'POST',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            window.location.href = '/index.php';
                        } else if (response.message) {
                            $("#loginAlert").removeClass('d-none').html(response.message);
                        }
                    },
                    error: function() {
                        $("#loginAlert").removeClass('d-none').html('Erro ao realizar login!');
                    }
                });
            });
        });
    </script>
</body>
</html>
