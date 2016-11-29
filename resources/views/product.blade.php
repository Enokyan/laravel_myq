@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h1>All_Product</h1></div>
   
                <div class="panel-body">
                <table border="1px solid">
                    <?php foreach ($product as $result): ?>   
                        <tr id=<?php echo $result->id;?>>
                            <td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $result->name_product;?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
                            <td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $result->price;?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
                            <td >
                            <img src='img/<?php echo $result->image_name;?>' style='max-height: 150px;max-width: 150px'>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </table>
                    {!! $product->links() !!}    
                </div>
            </div>
        </div>
    </div>
</div>
@stop
 