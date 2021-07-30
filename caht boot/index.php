<?php
$servername='localhost';
$username='root';
$password='';
$dbname='robots';
$con = new mysqli($servername,$username,$password,$dbname);
$con->set_charset("utf8");
if($con->connect_error)
	die("error". $con->connect_error);
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/bootstrap.rtl.min.css">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;700;900&display=swap">
        <link rel="stylesheet" href="css/style.css">
        <title>لوحة التحكم</title>
    </head>
    <body>
        <main>
            <div class="content">
                <div class="container">
                    <h1 class="mb-4 text-center">لوحة التحكم بالروبوت</h1>

                    <?php

                    $robotsData=$con->query("Select * from all_robots");
                    $robot = array();
                    $robotVal = [];

                    while($robot = $robotsData->fetch_assoc()) {
                        array_push($robotVal, $robot["value"]);
                    }
                    
                    if(isset($_POST["save_data"])) {
                        $robots = array(
                            1=>$_POST["r1"],
                            2=>$_POST["r2"],
                            3=>$_POST["r3"],
                            4=>$_POST["r4"],
                        );
                        foreach ($robots as $id => $robot) {
                            $query = "UPDATE all_robots SET value='".$robot."' WHERE 
                            id='".$id."' ";
                            $con->query($query);
                        }
                        ?>
                            <div class="position-fixed bottom-0 start-0 p-3" style="z-index: 11">
                                <div id="saveTost" class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
                                    <div class="toast-header">
                                        <strong class="me-auto">معلومات</strong>
                                        <small>الآن</small>
                                    </div>
                                    <div class="toast-body text-dark">تم حفظ المعلومات بنجاح</div>
                                </div>
                            </div>
                        <?php
                            header("Refresh:3");
                    }

                    ?>

                    <form action="" method="POST" class="shadow-lg p-3 rounded" style="width: 35rem;">
                        <div class="input-group shadow p-3 mb-1">
                            <label for="robot1" name="robot1" class="form-label">
                                المحرك الأول
                                <strong><?php echo $robotVal[0]; ?></strong>
                            </label>
                            <input type="range" class="input-range w-100 disabled" name="r1" min="0" max="100" step="1" id="robot1" value="<?php echo $robotVal[0]; ?>" disabled>
                        </div>
                        <div class="input-group shadow p-3 mb-1">
                            <label for="robot2" name="robot1" class="form-label">
                                المحرك الثاني
                                <strong><?php echo $robotVal[1]; ?></strong>
                            </label>
                            <input type="range" class="input-range w-100 disabled" name="r2" min="0" max="100" step="1" id="robot2" value="<?php echo $robotVal[1]; ?>" disabled>
                        </div>
                        <div class="input-group shadow p-3 mb-1">
                            <label for="robot3" name="robot1" class="form-label">
                                المحرك الثالث
                                <strong><?php echo $robotVal[2]; ?></strong>    
                            </label>
                            <input type="range" class="input-range w-100 disabled" name="r3" min="0" max="100" step="1" id="robot3" value="<?php echo $robotVal[2]; ?>" disabled>
                        </div>
                        <div class="input-group shadow p-3 mb-1">
                            <label for="robot4" name="robot1" class="form-label">
                                المحرك الرابع
                                <strong><?php echo $robotVal[3]; ?></strong>
                            </label>
                            <input type="range" class="input-range w-100 disabled" name="r4" min="0" max="100" step="1" id="robot4" value="<?php echo $robotVal[3]; ?>" disabled>
                        </div>
                        <div class="input-group justify-content-center mb-3 mt-4">
                            <button class="btn btn-primary" type="button" id="runBtn">تشغيل</button>
                            <button class="btn btn-success disabled" type="submit" name="save_data" disabled>حفظ</button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
        <div class="position-fixed bottom-0 start-0 p-3" style="z-index: 11">
            <div id="liveToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <strong class="me-auto">معلومات</strong>
                    <small>الآن</small>
                </div>
                <div class="toast-body"></div>
            </div>
        </div>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/main.js"></script>
        <script>
            window.watsonAssistantChatOptions = {
                integrationID: "67b37d35-e4b4-4708-aa9f-a8e9cf9ae471", // The ID of this integration.
                region: "us-south", // The region your integration is hosted in.
                serviceInstanceID: "950c302f-4c3b-4fe1-9a3d-917d633baf0f", // The ID of your service instance.
                onLoad: function(instance) { instance.render(); }
              };
            setTimeout(function(){
              const t=document.createElement('script');
              t.src="https://web-chat.global.assistant.watson.appdomain.cloud/loadWatsonAssistantChat.js";
              document.head.appendChild(t);
            });
        </script>
    </body>
</html>