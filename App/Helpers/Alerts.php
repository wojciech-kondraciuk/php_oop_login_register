<?php

namespace App\Helpers;

class Alerts {
  /**
   * Create a bootstrap success alert
   * @param  String $bold  - First words in the alert. Will be put inside <strong> html tag for emphasis
   * @param  String $message - What will be used for the main description in the alert
   */
  public static function successAlert($bold, $message) {
    echo '<div class="container">
            <div class="alert alert-success fade in">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>'.$bold.'</strong> '.$message.'
            </div>
          </div>';
  }

  /**
   * Create a bootstrap danger alert
   * @param  String $bold  - First words in the alert. Will be put inside <strong> html tag for emphasis
   * @param  String $message - What will be used for the main description in the alert
   */
  public static function dangerAlert($bold, $message) {
    echo '<div class="container">
            <div class="alert alert-danger fade in">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>'.$bold.'</strong> '.$message.'
            </div>
          </div>';
  }

  /**
   * Create a bootstrap info alert
   * @param  String $bold  - First words in the alert. Will be put inside <strong> html tag for emphasis
   * @param  String $message - What will be used for the main description in the alert
   */
  public static function infoAlert($bold, $message) {
    echo "<div class='alert $bold'>
          <span class='closebtn' onclick='this.parentElement.style.display='none';'>&times;</span> 
          <strong>Danger!</strong>$message</div>";
  }
}              
?>