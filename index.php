<html>
    <head>    
        <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
        <script src="contactformajax.js"></script>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    </head>
    <body>

    <style>
        .input-error{
            border:1px solid red;
        }
    </style>

    <form action="contactformajax.php" method="post" class="contactformajax">

        <div>
            <label>Name:</label>
            <input type="text" id="name" name="name"  class="required">
        </div>
        
        <div>
            <label>Email:</label>
            <input type="text" id="email" name="email" class="required email">
        </div>
        
        <div>
            <label>Message:</label>
            <textarea id="message" name="message" class="required"></textarea>
        </div>

        <div class="g-recaptcha" id="gcaptcha" data-sitekey="6Lf5Id0UAAAAAK_HpUg4xsAi28ZQlHJSICYlyGIw"></div>
        
        <div>
            <input type="submit" id="submitcontactformajax" class="button">
        </div>

        <p id="form-message"></p>

    </form>

    </body>
</html>