<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Facture</title>
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
        background-color: rgba(118, 193, 206, 0.363)
    }
    .body table tr{
        border: solid 1px black
    }
    .body table tbody td{

        border: solid 1px black;
    }
    .body table tfoot td{
        background-color: rgba(202, 247, 255, 0.459);
        border: solid 1px black;
    }
    .body table thead{
        padding: 5px;
        background-color: #16b4b9;
        color: white;
        text-align: center
    }
    .total td{
        background-color:  rgb(79, 202, 161)!important;
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
        $list = json_decode($invoice->product_details)
        ?>
    <!-- logoEveamart.png Nothing in life is to be feared, it is only to be understood. Now is the time to understand more, so that we may fear less. - Marie Curie -->
    <div class="company-side">
        <img src="{{'data:image/png;base64,'.base64_encode(file_get_contents(public_path('images/logoEveamart.png')))}}" width="200px">  <p>
            <h1>Facture</h1>
            <b>version du logiciel:</b> 2.0<br>
            <b>Boutique:</b>{{$invoice->Mart_name}} <br>
        </p>
    </div>
    <div class="client-side">
        <p><b>Date:</b> <br> {{$invoice->created_at}}</p>
        <p>
            <b>Nom du Client :</b>{{$invoice->client_name}} <br>
            <b>Addresse du Client :</b>{{$invoice->region}},{{$invoice->city}} <br>
            <b>email du Client :</b>{{$invoice->client_email}} <br>
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
                <td>prix</td>
            </tr>
        </thead>
        <tbody>   <tr>
                <td>
                    {{$list->id}}
                </td>    
                <td>
                    {{$list->name}}
                </td>
                <td>
                    {{$list->qty}}
                </td>
                <td>{{$list->price}} XAF</td>
            </tr> 
        </tbody>       
    </table>
        <table class="t2">
            
            <tr class="total">
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td><b>valeur commande</b></td>
                <td>{{$invoice->total_price}}</td>
            </tr>
            <tr>
                <td><b>mode de Paiement</b></td>
                <td>{{$invoice->Payment_mode}}</td>
            </tr>
        </table>
    <div class="stamp">
        Paid
    </div>
    <div class="code">
        <h4> Scan code </h4>

<img src="data:image/png;base64, {{ base64_encode(QrCode::size(200)->generate($invoice)) }} ">
    </div>
</div>
</div>
</body>
</html>