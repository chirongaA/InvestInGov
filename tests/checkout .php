<?php
include('express-stk.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <style>
            @import url('https://fonts.googleapis.com/css?family=Lato:400');
            @import url('https://fonts.googleapis.com/css?family=Source+Code+Pro:400');

            .container{
                display: flex;
                align-items: center;
                justify-content: center;
                height: 100vh;
                flex-direction: column;
            }

            *{ box-sizing: border-box;}

            html{
                background-color: #171A3D;
                font-family: 'Lato', sans-serif;
            }

            .price h1{
                font-weight: 300;
                color: #18C2C0;
                letter-spacing: 2px;
                text-align: center;
            }

            .card{
                margin-top: 30px;
                margin-bottom: 30px;
                max-width: 520px;
                width: 90%;
            }

            .card .row{
                width: 100%;
                padding: 1rem 0;
                border-bottom: 1.2px solid #292C58;
            }

            .card .row.number{background-color: #242852;}

            .cardholder .info .number .info{
                position: relative;
                margin-left: 40px;
            }

            .cardholder .info label, .number .info label{
                display: inline-block;
                font-size: 12px;
                color: #8E92C3;
                font-weight: 300;
                letter-spacing: 0.5px;
                width: 40%;
            }

            .cardholder .info input, .number .info input{
                display: inline-block;
                width: 55%;
                background-color: transparent;
                font-family: 'Source Code Pro';
                border: none;
                outline: none;
                margin-left: 1%;
                color: #fff;
            } 

            .cardholder .info input::placeholder, .number .info input::placeholder{
                color: #444800;
                font-family: 'Source Code Pro';
            }

            #cardnumber, #cardnumber::placeholder{
                letter-spacing: 2px;
                font-size: 16px;
            }

            .button button{
                width: 100%;
                max-width: 520px;
                background-color: #18C2C0;
                color: #fff;
                font-family: 'Lato';
                font-weight: 400;
                font-size: 1.2rem;
                padding: 18px;
                border-radius: 5px;
                border: none;
                outline: none;
                cursor: pointer;
                transition: background-color 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                letter-spacing: 1px;
            }

            .button button:hover{
                background-color: #15aeac;
            }

            .button button:active{
                background-color: #139b99;
            }

            .button button i{
                margin-right: 5px;
                font-size: 1.2rem;
            }
            </style>
    </head>
    <body>
        <div class="container">
            <form action= '<?php echo $_SERVER['PHP_SELF']; ?>' method='POST'>
                <div class = "price">
                    <h1>Checkout</h1>
                </div>
                <div class= "card_container">
                    <div class="card">
                        <div class="row">
                            <img src= "../images/icons8-mpesa-48.png" style="width: 30%; margin: 0 35%;">
                            <p style = "color: #8F9C23; line-height: 1.7;"> 1. Enter the <b> Phone Number </b> and press "<b> Confirm and Pay</b>" </br>
                            2. You will receive a prompt on your phone. Enter your <b> MPESA PIN</b>
                        </p>

                        <?php if ($errmsg !=''): ?>
                            <p style="background: #cc2a24; padding: .8rem; color:#ffffff"><?php echo $errmsg; ?></p>
                        <?php endif; ?>
                        </div>
                        <div class="row number">
                            <div class="info">
                                <input type="hidden" name="orderNo" value=""/>
                                <label for="cardnumber">Phone Number</label>
                                <input id= "cardnumber" type="text" name="phone_number" maxlength="10" placeholder="07********" required/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="button">
                    <button type="submit" name="submit" value="submit"><i class="fa fa-lock"></i>Confirm and Pay</button>
                </div>
        </form>
        <p style="color: #8F9C23; line-height: 1.7; margin-top:5rem;"> Copyright 2024 | All rights reserved | Made by InvestInGov </p>
        </div>
    </body>
</html>
