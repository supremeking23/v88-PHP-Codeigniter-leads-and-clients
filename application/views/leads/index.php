<?php 
    if($this->session->has_userdata("from")){
        $date_from=date_create($this->session->userdata("from"));
        $format_from = date_format($date_from,"M d,Y");

        $date_to=date_create($this->session->userdata("to"));
        $format_to = date_format($date_to,"M d,Y");
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leads and Client</title>
     <!-- Bootstrap CSS -->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

     <link rel="stylesheet" href="<?=base_url()?>assets/css/style.css">
     <style>
         #chartContainer{
             height:370px;
             width:100%;
         }
         .red {
             /* background:red; */
             padding:20px;
             height:800px;
             overflow-y:scroll;
         }
     </style>
     <script>
        window.onload = function () {

            var options = {
                title: {
                    text: "Customers and numbers of new leads"
                },
                subtitles: [{
                    text: "FROM: <?= ($this->session->has_userdata("from") ? $format_from : "");?> TO: <?= ($this->session->has_userdata("to") ? $format_to : "");?>"
                }],
                exportEnabled: true,
                animationEnabled: true,
                data: [{
                    type: "pie",
                    startAngle: 40,
                    toolTipContent: "<b>{label}</b>: {y}%",
                    showInLegend: "true",
                    legendText: "{label}",
                    indexLabelFontSize: 16,
                    indexLabel: "{label} - {y}%",
                    dataPoints: [
<?php foreach($leads as $lead):?>
                        { y: <?= $lead['number_of_leads'] ?>, label: "<?= $lead['client_name'] ?>" },
                       
<?php endforeach;?>
                    ]
                }]
            };
            $("#chartContainer").CanvasJSChart(options);

        }
    </script>
</head>
<body>
    <nav class="navbar navbar-light bg-light">
        <span class="navbar-brand mb-0 h1">Report Dashboard</span>
    </nav>


    <div class="container-fluid">
        <div class="row mt-5">
            <div class="col-md-12 d-flex flex-row-reverse">
                <?php echo form_open("leads/update") ?>
                <!-- <form action="<?= base_url()?>leads/update" method="POST"> -->
                    <input type="date" name="from" id="from">
                    <input type="date" name="to" id="to">
                    <input type="submit" class="btn btn-sm btn-info" value="Update">
                </form>
            </div>
            <div class="row  mt-5">
                <div class="col-md-12">
                    <?= $this->session->flashdata("errors");?>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-5 red">
                <h2>List of all customers and # of leads</h2>
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                        <th scope="col">Customer Name</th>
                        <th scope="col">Number of leads</th>
                    
                        </tr>
                    </thead>
                    <tbody>
<?php foreach($leads as $lead):?>
                        <tr>
                            <td scope="row"><?=$lead['client_name'] ?></td>
                            <td><?=$lead['number_of_leads'] ?></td>
                        </tr>
<?php endforeach;?>
                    </tbody>
                </table>   
            </div>
            <div class="col-md-7">
                <div id="chartContainer"></div>
            </div> 
        </div> 

        <div class="row mt-5">
             <!-- <div class="col-md-6">
                <div id="chartContainer"></div>
            </div>    -->
        </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>
</body>
</html>