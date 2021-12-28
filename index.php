<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INDEX CHECKER | BY NIX3R</title>
    <link rel="shortcut icon" href=" " type="image/x-icon">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.3.0/dist/sweetalert2.all.min.js"></script>
    <link href="https://kit-pro.fontawesome.com/releases/v5.15.4/css/pro.min.css" rel="stylesheet">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Muli:300,300i,400,400i,600,600i,700,700i%7CComfortaa:300,400,700" rel="stylesheet">
    <link rel="shortcut icon" href="https://cdn-icons-png.flaticon.com/512/25/25231.png" type="image/x-icon">
</head>
<style>
   .card{
      box-shadow: 0px 0px 32px rgba(0, 0, 0, .03);
      background-color: white;
   }
   body{
      background-color: whitesmoke;
   }
</style>
<body>
   <div class="col-md-12">
      <div class="card-body text-center">
      <div class="card mt-8">
      <br>
      <h2 class="text-dark card-title" style="text-shadow: 0 1px 7px rgba(0,0,0,0.50);">INDEX FREE</h2>
      <br>
      <center>
      <textarea id="lista" class="form-control form-checker text-center" style="width: 90%;" placeholder="INSIRA SUA LISTA"></textarea>
  </center>
      <br>
      <center>
      <button class="btn btn-danger mb-3" style="width: 50%; font-size: 1.5em !important;" onclick="enviar()">INICIAR</button></center>
      <br>
      <h6 class="text-dark">Lives: <span id="livescc">0</span> Dies: <span id="diescc">0</span> Total: <span id="total">0</span></h6>
  </div>
  </div>
  </div>
  <center>
     <div class="aprovadas" id="aprovadas"></div>
     <div class="reprovadas" id="reprovadas"></div>
  </center>
</body>

<script title="ajax">
        var audio = new Audio('live.wav');
        function enviar() {
            Swal.fire({
            icon: 'warning',
            title: 'Teste Iniciado',
            timer: 2000,
            timerProgressBar: true,
            showConfirmButton: false,
            position: 'top-end',
            toast: true,
            width: 600,
            padding: '3em',
            color: 'dark',
            })
            var linha = $("#lista").val();
            var linhaenviar = linha.split("\n");
            var total = linhaenviar.length;
            var ap = 0;
            var rp = 0;
            linhaenviar.forEach(function(value, index) {
                setTimeout(
                    function() {
                        $.ajax({
                            url: 'api.php?lista=' + value,
                            type: 'GET',
                            async: true,
                            success: function(resultado) {
                                if (resultado.match("Aprovada")) {
                                    audio.play();                                    
                                    Swal.fire({
                                    icon: 'success',
                                    title: '+1 Live.',
                                    timer: 1500,
                                    timerProgressBar: true,
                                    showConfirmButton: false,
                                    position: 'top-end',
                                    toast: true,
                                    width: 600,
                                    padding: '3em',
                                    color: 'dark',
                                    })
                                    removelinha();
                                    ap++;
                                    aprovadas(resultado + "");
                                }else {
                                    removelinha();
                                    rp++;
                                    reprovadas(resultado + "");
                                }
                                $('#carregadas').html(total);
                                var fila = parseInt(ap) + parseInt(rp);
                                $('#livescc').html(ap);
                                $('#diescc').html(rp);
                                $('#total').html(fila);
                            }
                        });
                    }, 8000 * index);
            });
        }
        function aprovadas(str) {
            $(".aprovadas").append(str + "<br>");
        }
        function reprovadas(str) {
            $(".reprovadas").append(str + "<br>");
        }
        function removelinha() {
            var lines = $("#lista").val().split('\n');
            lines.splice(0, 1);
            $("#lista").val(lines.join("\n"));
        }
    </script>

</html>