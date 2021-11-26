<div class="ticket abs-center">
    <img src="http://127.0.0.1:8000/storage/VariedadesCindyLogo-cutout.png" alt="Logotipo">
    <br>
    <p class="centrado">Variedades Cindy<br>Telefono 27222871<br>Direccion: Iglesia Católica 1/2<br> C. al norte Yalagüina
        <br>Cajero: {{Auth::user()->name}}
        <br>Recibo de pago {{str_pad($pago->id, 4, "0", STR_PAD_LEFT);}}
        <br>Fecha {{$pago->created_at->isoFormat('Y-M-D h:mm:ss: A')}}
        <br>Cliente {{$pago->nombre}} {{$pago->apellido}}
        <br>Cédula {{$pago->cedula}}
        <br>Articulo {{$pago->articulo}}
        <br>Abona {{$divisa}} {{$pago->abona}} <br> Saldo {{$divisa}} {{$pago->saldo}}
        <br>Firma 
        <br>¡Gracias por preferirnos!
    </p>
</div>
