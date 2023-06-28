<?php function drawFaq()
{ ?>

    <body>
        <h1 class="faq-title">FAQ</h1>
        <ul id="accordion">
            <li>
                <label for="first"> How long does it typically take to resolve a trouble ticket? <span>&#x3e;</span></label>
                <input type="radio" name="accordion" id="first">
                <div class="content">
                    <p> The time to resolve a trouble ticket may vary depending on the nature and complexity of the issue.
                        Our support team strives to address tickets as quickly as possible. </p>
                </div>
            </li>
            <li>
                <label for="second"> I need assistance with campus Wi-Fi connectivity problems. <span>&#x3e;</span></label>
                <input type="radio" name="accordion" id="second">
                <div class="content">
                    <p> On your device, navigate to the Wi-Fi settings and "forget" the university's Wi-Fi network.
                        Then, reconnect to it by selecting the network and entering your login credentials again. </p>
                </div>
            </li>
            <li>
                <label for="third"> I've forgotten my password, what should I do? <span>&#x3e;</span></label>
                <input type="radio" name="accordion" id="third">
                <div class="content">
                    <p> If you forget your university email password, you can reset it by visiting the password reset page on our website.
                        Follow the instructions provided to regain access to your email account. </p>
                </div>
            </li>
            <li>
                <label for="forth"> What should I do if I encounter issues with printing on campus? <span>&#x3e;</span></label>
                <input type="radio" name="accordion" id="forth">
                <div class="content">
                    <p>
                        If you encounter issues with printing on campus, first ensure that you have sufficient print credits or funds in your printing account.
                    </p>
                </div>
            </li>
        </ul>
    </body>
<?php } ?>