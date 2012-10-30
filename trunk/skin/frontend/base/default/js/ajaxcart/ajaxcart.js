/**
 * @category    Mage
 * @package     Mage_Checkout
 * @copyright   Copyright (c) 2011 Lucid Dreams (http://lucid-dreams.pl)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @author      Marcin Roszak <magento@lucid-dreams.pl>
 */

var $j = jQuery.noConflict();

$j(document).ready(function() {
    var baseUrl = location.protocol +'//' + Mage.Cookies.domain.replace(/^\./g, '') + Mage.Cookies.path;
    $j('.btn-cart').each(function() {
        var original_onclick_action = $j(this).attr('onclick');
        this.onclick = undefined;
        
        $j(this).click(function() {

            var func = original_onclick_action.toString();
            var url = func.match(/product\/[0-9]+/);
            var href = baseUrl + '/ajaxcart/cart/add/' + url;
            $j('.block-cart').hide('slow');

            $j.get(href, function(data) {
                $j.get(baseUrl + '/ajaxcart/cart/update',function(cart){
                    $j('.block-cart').html(cart);
                    $j('.block-cart').show('slow');
                });
            });
        });
    });
});


