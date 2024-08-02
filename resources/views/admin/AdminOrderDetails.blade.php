<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Recu</title>
</head>
<body>
<style>
    @font-face {
    font-family: 'Riot';
    src: url({{storage_path('/fonts/ProtestRiot-Regular.ttf')}}) format("truetype");
    font-weight: 400; 
    font-style: normal; 
    }
    body{
        font-family: "Riot"
    }
    .facture{
        width: 100%;
        position: relative;
    }
    .company-side{
        position: absolute;
        top: 0px;
        left: 10px;
    }
    .company-side p{
        margin-left:34px ;
    }
    .client-side{
        position: absolute;
        right: 10px;
        top: 10px
    }
    .body{
        margin: 10px;
    }
    .body table{
        text-align: center;
        border-collapse: collapse;
    }
    .t1{
        width: 98%;
    }
    .t2{
        width: 40%;
        background-color: rgba(206, 118, 118, 0.363)
    }
    .body table tr{
        border: solid 1px black
    }
    .body table tbody td{

        border: solid 1px black;
    }
    .body table tfoot td{
        background-color: rgba(255, 202, 202, 0.459);
        border: solid 1px black;
    }
    .body table thead{
        padding: 5px;
        background-color: rgb(170, 10, 10);
        color: white;
        text-align: center
    }
    .total td{
        background-color:  rgb(224, 0, 0)!important;
        height: 4px;
    }
    .stamp{
        color:rgb(0, 169, 199);
        font-weight: bolder;
        z-index: -9;
        font-size: 6rem;
        position: absolute;
        left:80px;
        bottom: 200px;
        transform: rotate(-30deg)
    }
    .code{
        position: absolute;
        right: 10px;
        text-align: center
    }
</style>
<div class="facture">
    <?php 
        $list = json_decode($order->super_cart)
        ?>
    <!-- logoEveamart.png Nothing in life is to be feared, it is only to be understood. Now is the time to understand more, so that we may fear less. - Marie Curie -->
    <div class="company-side">
        <img src="{{'data:image/png;base64,'.base64_encode(file_get_contents(public_path('images/logoEveamart.png')))}}" width="200px">  <p>
            <b>software version:</b> 2.0<br>
            <b>address:</b>total melen <br>
            <b>Numero :</b> 653 75 75 15 <br>
            <b>Email</b> chendjousil@gmail.com <br>
            <b>Web Site:</b> www.eveamart.cm
        </p>
    </div>
    <div class="client-side">
        <p><b>Date:</b> <br> {{$order->created_at}}</p><br><br><br>
        <p>
            <b>Nom du Client :</b>{{$order->client_name}} <br>
            <b>Addresse du Client :</b>{{$order->order_region}},{{$order->order_city}} <br>
            <b>Numero de Telephone :</b>{{$order->client_phone}} <br>
            <b>email du Client :</b>{{$order->client_email}} <br>
        </p>
    </div>
    <br><br><br><br><br><br><br><br><br><br>
    <br><br><br><br><br><br><br><br><br><br>
    <div class="body">
    <p><b>objectif :</b> Commande</p>
    <table class="t1">
        <thead >
            <tr>
                <td>s/l</td>
                <td>Nom</td>
                <td>qte</td>
                <td>poid</td>
                <td>tax</td>
                <td>prix</td>
                <td>boutique</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($list as $list)
               <tr>
                <td>
                    {{$list->id}}
                </td>    
                <td>
                    {{$list->name}}
                </td>
                <td>
                    {{$list->qty}}
                </td>
                <td>
                    {{$list->options->weight}} kg
                </td>
                <td>{{$list->tax}}</td>
                <td>{{$list->price}} XAF</td>
                <td>{{$list->options->mart}}</td>
            </tr> 
            @endforeach
        </tbody>       
    </table>
        <table class="t2">
            
            <tr class="total">
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td><b>Poid Total</b></td>
                <td>{{$order->total_weight}}</td>
            </tr>
            <tr>
                <td><b>Somme  Total</b></td>
                <td>{{$order->total_price}}</td>
            </tr>
            <tr>
                <td><b>mode de Paiement</b></td>
                <td>{{$order->payment_mode}}</td>
            </tr>
        </table>
    <div class="stamp">
        Paid
    </div>
    <div class="code">
        <h4> Scan code </h4>

<img src="data:image/png;base64, {{ base64_encode(QrCode::size(200)->generate($order)) }} ">
    </div>
</div>
</div>
</body>
</html>