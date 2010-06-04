<?php
/**
 * PSOCheckoutPage.class.php
 *
 * This file contains the definition of the PSOCheckoutPage class.
 *
 * @package Pages
 * @author John Diamond <jdiamond@solid-state.org>
 * @copyright John Diamond <jdiamond@solid-state.org>
 * @license http://www.opensource.org/licenses/gpl-license.php GNU Public License
 */

// Include the parent class
require_once BASE_PATH . "include/SolidStatePage.class.php";

require_once BASE_PATH . "DBO/OrderDBO.class.php";

/**
 * PSOCheckoutPage
 *
 * Prepares a cart upload for Paypal checkout.
 *
 * @package Pages
 * @author John Diamond <jdiamond@solid-state.org>
 */
class PSOCheckoutPage extends SolidStatePage {
	/**
	 * @var Paypal Paypal Module object
	 */
	var $ppModule;

	/**
	 * Action
	 *
	 * Actions handled by this page:
	 *
	 * @param string $action_name Action
	 */
	function action( $action_name ) {
		switch ( $action_name ) {
			case "pso_checkout":
				if ( isset( $this->post['back'] ) ) {
					$this->gotoPage( "review" );
				}
				elseif ( isset( $this->post['startover'] ) ) {
					$this->newOrder();
				}
				break;

			default:
				// No matching action - refer to base class
				parent::action( $action_name );

		}
	}

	/**
	 * Dump the Cart
	 *
	 * Dumps the cart to a table that will be processed by the template.
	 *
	 * @return array Cart data
	 */
	function dumpCart() {
		$cart = array();
		foreach( $_SESSION['order']->getItems() as $orderItemDBO ) {
			if ( $orderItemDBO->getOnetimePrice() != null ) {
				$cart[] = array( "name" => $orderItemDBO->getDescription(),
						"quantity" => 1,
						"amount" => $orderItemDBO->getOnetimePrice(),
						"tax" => $orderItemDBO->getOnetimeTaxes() );
			}
			elseif ( $orderItemDBO->getRecurringPrice() != null ) {
				$cart[] = array( "name" => $orderItemDBO->getDescription(),
						"quantity" => 1,
						"amount" => $orderItemDBO->getRecurringPrice(),
						"tax" => $orderItemDBO->getRecurringTaxes() );
			}
		}
		return $cart;
	}

	/**
	 * Initialize the Page
	 */
	function init() {
		parent::init();

		$registry = ModuleRegistry::getModuleRegistry();
		$this->ppModule = $registry->getModule( 'paypalwps' );

		$this->smarty->assign( "account", $this->ppModule->getAccount() );
		$this->smarty->assign( "cartURL", $this->ppModule->getCartURL() );
		$this->smarty->assign( "currencyCode", $this->ppModule->getCurrencyCode() );
		$this->smarty->assign( "orderid", $_SESSION['order']->getID() );

		// Dump the cart contents into a Smarty variable.  The Paypal cart upload
		// form will be generated by the template.
		$this->smarty->assign( "paypalCart", $this->dumpCart() );
	}

	/**
	 * Start New Order
	 */
	function newOrder() {
		// Start a new order
		unset( $_SESSION['order'] );
		$this->gotoPage( "cart" );
	}
}
?>