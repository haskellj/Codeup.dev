<?php
  var_dump($_GET);
  var_dump($_POST);
?>

<!DOCTYPE html>
<html>
<head>
	<title>My First HTML Form</title>
</head>
<body>
  <h2>User Login</h2>
    	<form method="POST" action="my_first_form.php">
        <p>
            <label for="username">Username</label>
            <input id="username" name="username" placeholder="Username" type="text">
            @gmail.com
        </p>
        <p>
            <label for="password">Password</label>
            <input id="password" name="password" placeholder="Enter your password" type="password">
        </p>
        <p>
           <!-- <input type="submit" value="Login"> -->
           <button type="submit">Login Now!</button>
        </p>
    </form>
  <h2>Compose an Email</h2>
    <form>
        <p>
            <label>To:</label>
            <input type="text" id="to_recipient" name="to_recipient" placeholder="Recipient's Email Address">
        </p>
        <p>
            <label for="email_subject">Subject:</label>
            <textarea id="email_subject" name="email_subject" rows="1" cols="32"></textarea>
        </p>
        <p>
            <label for="email_body">Compose Your Message:</label><br>
            <textarea id="email_body" name="email_body" rows="5" cols="40" placeholder="Write your message here."></textarea>
        </p>
        <p>
            <input type="submit" value="Send">
        </p>
        <p>
            <label for="copyTo_sentFolder">Save a copy to your Sent folder
                <input type="checkbox" id="copyTo_sentFolder" name="Copy to Sent Folder?" value="yes" checked>
            </label>
        </p>
    </form>
  <h2>Multiple-Choice Test</h2>
    <form>
        <p>1. <strong>The sky is blue because that is God's favorite color.</strong></p>
              <label for="Q1T">True
                <input type="radio" id="Q1T" name="Q1" value="True"> 
              </label>
              <label for="Q1F">False
                <input type="radio" id="Q1F" name="Q1" value="False"> 
              </label>
        <p>2. <strong>Learning to program in HTML can be accomplished in one day.</strong></p>
              <label for="Q2T">True
                <input type="radio" id="Q2T" name="Q2" value="True"> 
              </label>
              <label for="Q2F">False
                <input type="radio" id="Q2F" name="Q2" value="False"> 
              </label>
        <p>3. <strong>Which of the following are programming languages?</strong> <em>(check all that apply)</em></p>
              <label for="Q3i"><input type="checkbox" id="Q3i" name="Q3[]" value="HTML">HTML</label><br>  
              <label for="Q3ii"><input type="checkbox" id="Q3ii" name="Q3[]" value="CSS">CSS</label><br>  
              <label for="Q3iii"><input type="checkbox" id="Q3iii" name="Q3[]" value="Ubuntu">Ubuntu</label><br>  
              <label for="Q3iv"><input type="checkbox" id="Q3iv" name="Q3[]" value="Haskell">Haskell</label>  
        <p>4. <strong>Which of the following are fruit?</strong> <em>(select all that apply by holding down the ctrl/command key)</em></p>
              <label for="Q4"></label>
                <select id="Q4" name="Q4[]" multiple>
                    <option value="1">Apple</option>
                    <option value="1">Banana</option>
                    <option value="0">Potato</option>
                    <option value="1">Tomato</option>
                    <option value="1">Lime</option>
                    <option value="1">Blueberry</option>
                </select>
        <p>
            <button type="submit">Submit Test</button>
        </p>
    </form>
  <h2>Select Testing</h2>
    <form>
        <p>
            <label for="selected">Select an option:</label>
                <select id="selected" name="YorN">
                    <option>Yes</option>
                    <option disabled>No</option>
                    <option selected></option> 
                <input type="submit">
        </p>
    </form>
</body>
</html>