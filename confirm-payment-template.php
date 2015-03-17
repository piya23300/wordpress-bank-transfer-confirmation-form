<?php
/*
Template Name: Contact
*/
?>

<?php

require "models/bank-transfer.php";


$BankTransfer = new BankTransfer( $_POST );
if( isset($_POST['submitted']) && $_POST['submitted'] == true ) {
  $BankTransfer->send_email();
}

?>
<?php get_header(); ?>
  <div id="container">
    <div id="content">

      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      <div <?php post_class() ?> id="post-<?php the_ID(); ?>">
        <h1 class="entry-title"><?php the_title(); ?></h1>
          <div class="entry-content">
            <?php if( $BankTransfer->email_sent == true ) { ?>
              <div class="thanks">
                <p>Thanks, your email was sent successfully.</p>
              </div>
            <?php } else { ?>
              <?php the_content(); ?>
              <?php if( !empty($BankTransfer->error_messages) ) { ?>
                <p class="error">Sorry, an error occured.<p>
              <?php } ?>

            <form action="<?php the_permalink(); ?>" id="contactForm" method="post">
              <ul class="contactform">
              <li>
                <label for="contact_name">Name:</label>
                <input type="text" name="contact_name" id="contact_name" value="<?php echo $BankTransfer->contact_name; ?>" class="required requiredField" />
                <?php if( isset($BankTransfer->error_messages['contact_name'])) { ?>
                  <span class="error"><?= $BankTransfer->error_messages['contact_name']; ?></span>
                <?php } ?>
              </li>

              <li>
                <label for="email">Email:</label>
                <input type="text" name="email" id="email" value="<?php echo $BankTransfer->email; ?>" class="required requiredField" />
                <?php if( isset($BankTransfer->error_messages['email'])) { ?>
                  <span class="error"><?= $BankTransfer->error_messages['email']; ?></span>
                <?php } ?>
              </li>

              <li>
                <label for="telephone">Telephone:</label>
                <input type="text" name="telephone" id="telephone" value="<?php echo $BankTransfer->telephone; ?>" class="required requiredField" />
                <?php if( isset($BankTransfer->error_messages['telephone'])) { ?>
                  <span class="error"><?= $BankTransfer->error_messages['telephone']; ?></span>
                <?php } ?>
              </li>

              <li>
                <label for="order_number">Order Number:</label>
                <input type="text" name="order_number" id="order_number" value="<?php echo $BankTransfer->order_number; ?>" class="required requiredField" />
                <?php if( isset($BankTransfer->error_messages['order_number'])) { ?>
                  <span class="error"><?= $BankTransfer->error_messages['order_number']; ?></span>
                <?php } ?>
              </li>

              <li>
                <label for="bank_account">Bank Account:</label>
                <input type="text" name="bank_account" id="bank_account" value="<?php echo $BankTransfer->bank_account; ?>" class="required requiredField" />
                <?php if( isset($BankTransfer->error_messages['bank_account'])) { ?>
                  <span class="error"><?= $BankTransfer->error_messages['bank_account']; ?></span>
                <?php } ?>
              </li>

              <li>
                <label for="transfered_at">Transder At:</label>
                <input type="text" name="transfered_at" id="transfered_at" value="<?php echo $BankTransfer->transfered_at; ?>" class="required requiredField" />
                <?php if( isset($BankTransfer->error_messages['transfered_at'])) { ?>
                  <span class="error"><?= $BankTransfer->error_messages['transfered_at']; ?></span>
                <?php } ?>
              </li>

              <li>
                <label for="amount">Amount:</label>
                <input type="text" name="amount" id="amount" value="<?php echo $BankTransfer->amount; ?>" class="required requiredField" />
                <?php if( isset($BankTransfer->error_messages['amount'])) { ?>
                  <span class="error"><?= $BankTransfer->error_messages['amount']; ?></span>
                <?php } ?>
              </li>

              <li>
                <input type="submit">Send email</input>
              </li>
            </ul>
            <input type="hidden" name="submitted" id="submitted" value="true" />
          </form>
        <?php } ?>
        </div><!-- .entry-content -->
      </div><!-- .post -->

        <?php endwhile; endif; ?>
    </div><!-- #content -->
  </div><!-- #container -->

<?php get_footer(); ?>