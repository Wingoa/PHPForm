<?php
$user = array('first_name' => '', 'last_name' => '', 'street' => '', 'state' => 'AL', 'zip' => '', 'country' => "United States", 'tickets' => 0, 'pay' => 'Visa', 'total' => null, );
$errors = ['first_name' => '', 'last_name' => '', 'street' => '', 'state' => '', 'zip' => '', 'country' => '', 'tickets' => '', 'pay' => ''];
$message = '';
$heading = "<p>Tickets Cost $250.00 each.<br>Please complete and submit the form below to purchase concert tickets.<br></p>";

if ($_SERVER['REQUEST_METHOD'] == 'POST') { // If form submitted
  // Validation filters
  $validation_filters['first_name']['filter'] = FILTER_VALIDATE_REGEXP;
  $validation_filters['first_name']['options']['regexp'] = '/^[A-z]{2,10}$/';
  $validation_filters['last_name']['filter'] = FILTER_VALIDATE_REGEXP;
  $validation_filters['last_name']['options']['regexp'] = '/^[A-z]{2,10}$/';
  $validation_filters['street']['filter'] = FILTER_VALIDATE_REGEXP;
  $validation_filters['street']['options']['regexp'] = '/^[a-zA-Z0-9_ ]*$/';
  $validation_filters['state']['filter'] = FILTER_VALIDATE_REGEXP;
  $validation_filters['state']['options']['regexp'] = '/^[A-z]{2}$/';
  $validation_filters['zip']['filter'] = FILTER_VALIDATE_INT;
  $validation_filters['zip']['options']['min_range'] = 0;
  $validation_filters['zip']['options']['max_range'] = 99999;
  $validation_filters['tickets']['filter'] = FILTER_VALIDATE_INT;
  $validation_filters['tickets']['options']['min_range'] = 1;
  $validation_filters['country']['filter'] = FILTER_VALIDATE_REGEXP;
  $validation_filters['country']['options']['regexp'] = '/^[a-zA-Z0-9_ ]*$/';
  $validation_filters['pay']['filter'] = FILTER_VALIDATE_REGEXP;
  $validation_filters['pay']['options']['regexp'] = '/^[a-zA-Z0-9_ ]*$/';
  $validation_filters['total']['filter'] = FILTER_VALIDATE_FLOAT;
  $validation_filters['total']['options']['min_range'] = 0;

  $user = filter_input_array(INPUT_POST, $validation_filters); // Validate data

  // Create error messages
  $errors['first_name'] = $user['first_name'] ? '' : 'Name must be 2-10 letters using A-z';
  $errors['last_name'] = $user['last_name'] ? '' : 'Name must be 2-10 letters using A-z';
  $errors['street'] = $user['street'] ? '' : 'Please enter valid address between 2-50 characters';
  $errors['state'] = $user['state'] ? '' : 'Please select a state';
  $errors['zip'] = $user['zip'] ? '' : 'Please enter a valid zip code';
  $errors['country'] = $user['country'] ? '' : 'Please enter a valid country';
  $errors['tickets'] = $user['tickets'] ? '' : 'You must buy at least one ticket';
  $errors['pay'] = $user['pay'] ? '' : 'You must select payment method';
  $invalid = implode($errors); // Join error messages

  if ($invalid) { // If there are errors
    $message = '<span class="error">Please correct the following errors:</span><br>'; // Do not process
  } else { // Otherwise
    $message = '<p>Thank you, your data was valid.<p>';
    $heading = ''; // Can process data
  }

  // Sanitizate data
  $user['first_name'] = filter_var($user['first_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $user['last_name'] = filter_var($user['last_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $user['street'] = filter_var($user['street'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $user['zip'] = filter_var($user['zip'], FILTER_SANITIZE_NUMBER_INT);
  $user['tickets'] = filter_var($user['tickets'], FILTER_SANITIZE_NUMBER_INT);
}

?>
<html>

<head>
  <meta charset="utf-8" />
  <title>Taylor Swift Tickets</title>
  <link href="css/style.css" rel="stylesheet" />
  <link rel="icon" href="img/TaylorLogo.png" />
  <style>
    .row {
      margin-bottom: 25px !important;
    }
  </style>
  <script>

    const formatter = new Intl.NumberFormat('en-US', {
      style: 'currency',
      currency: 'USD',
    });

    function calcTotal(tickets) {
      this.form.total.value = formatter.format((tickets * 250.00) + (tickets * 250.00 * 0.06));
    }

  </script>
</head>

<div id="navbar">
  <div class="navbar">
    <a href="index.html">Home</a>

    <a href="https://www.taylorswift.com/">TaylorSwift.com</a>

    <a href="https://en.wikipedia.org/wiki/Taylor_Swift">Taylor Swift Wiki</a>

    <a href="https://www.instagram.com/taylorswift/?hl=en">Taylor Swift Instagram</a>

    <a href="Exam5prog2_Wingo.php">Buy Concert Tickets</a>
  </div>

</div>

<div class="container mb">

  <div class="card">
    <?= $heading ?>
      <?= $message ?>

  </div>

  <div class="card">

    <form action="Exam5prog2_Wingo.php" method="POST" id="form" name="form">
      <div class="row">
        <h3>Ticket Purchase Form</h3>

        <div class="col">
          First Name: <input type="text" name="first_name" value="<?= $user['first_name'] ?>" placeholder="First Name">
          <span class="error">
            <?= $errors['first_name'] ?>
          </span>
        </div>

        <div class="col">
          Last Name: <input type="text" name="last_name" value="<?= $user['last_name'] ?>" placeholder="Last Name">
          <span class="error">
            <?= $errors['last_name'] ?>
          </span>
        </div>
      </div>

      <div class="row">
        <p>Address:</p>
        <div class="col">
          Street: <input type="text" name="street" value="<?= $user['street'] ?>" placeholder="Street Address">
          <span class="error">
            <?= $errors['street'] ?>
          </span>
        </div>
        <div class="col">
          State:
          <select name="state">
            <option value="AL">Alabama</option>
            <option value="AK">Alaska</option>
            <option value="AZ">Arizona</option>
            <option value="AR">Arkansas</option>
            <option value="CA">California</option>
            <option value="CO">Colorado</option>
            <option value="CT">Connecticut</option>
            <option value="DE">Delaware</option>
            <option value="DC">District Of Columbia</option>
            <option value="FL">Florida</option>
            <option value="GA">Georgia</option>
            <option value="HI">Hawaii</option>
            <option value="ID">Idaho</option>
            <option value="IL">Illinois</option>
            <option value="IN">Indiana</option>
            <option value="IA">Iowa</option>
            <option value="KS">Kansas</option>
            <option value="KY">Kentucky</option>
            <option value="LA">Louisiana</option>
            <option value="ME">Maine</option>
            <option value="MD">Maryland</option>
            <option value="MA">Massachusetts</option>
            <option value="MI">Michigan</option>
            <option value="MN">Minnesota</option>
            <option value="MS">Mississippi</option>
            <option value="MO">Missouri</option>
            <option value="MT">Montana</option>
            <option value="NE">Nebraska</option>
            <option value="NV">Nevada</option>
            <option value="NH">New Hampshire</option>
            <option value="NJ">New Jersey</option>
            <option value="NM">New Mexico</option>
            <option value="NY">New York</option>
            <option value="NC">North Carolina</option>
            <option value="ND">North Dakota</option>
            <option value="OH">Ohio</option>
            <option value="OK">Oklahoma</option>
            <option value="OR">Oregon</option>
            <option value="PA">Pennsylvania</option>
            <option value="RI">Rhode Island</option>
            <option value="SC">South Carolina</option>
            <option value="SD">South Dakota</option>
            <option value="TN">Tennessee</option>
            <option value="TX">Texas</option>
            <option value="UT">Utah</option>
            <option value="VT">Vermont</option>
            <option value="VA">Virginia</option>
            <option value="WA">Washington</option>
            <option value="WV">West Virginia</option>
            <option value="WI">Wisconsin</option>
            <option value="WY">Wyoming</option>
          </select>
          <span class="error">
            <?= $errors['state'] ?>
          </span>

        </div>
      </div>

      <div class="row">
        <div class="col">
          Zip Code: <input type="text" name="zip" value="<?= $user['zip'] ?>" placeholder="Zip Code">
          <span class="error">
            <?= $errors['zip'] ?>
          </span>
        </div>
        <div class="col">
          Country:
          <select name="country">
            <option value="United States">United States</option>
          </select>
          <span class="error">
            <?= $errors['country'] ?>
          </span>
        </div>
      </div>

      <div class="row">
        <div class="col">
          Number of Tickets: <input form="form" type="number" name="tickets" id="tickets" placeholder="Tickets"
            onkeyup=" calcTotal(form.tickets.value)">
          <span class="error">
            <?= $errors['tickets'] ?>
          </span><br>

        </div>
      </div>
      <div class="card">
        <div class="row">
          <div class="col">
            Total: <input form="form" type="text" name="total" id="total" value="<?= $user['total'] ?>"
              placeholder="0.00">
          </div>
        </div>
        <div class="col">
          <span class="error">
            <?= $errors['pay'] ?>
          </span>
          <p>
            <input type="radio" name="pay" value="AE"> American Express
          </p>
          <p>
            <input type="radio" name="pay" value="Discover">Discover
          </p>
          <p>
            <input type="radio" name="pay" value="MC">Master Card
            </label>
          <p>
            <input type="radio" name="pay" value="Visa">Visa
          </p>
        </div>
      </div>
      <div class="row mt">
        <div class="col">
          <input type="reset" value="Clear Form">
        </div>
        <div class="col">
          <input type="submit" value="Submit Payment">
        </div>
      </div>
  </div>
  </form>
  <!-- <?= var_dump($_POST); ?> -->
</div>


</html>