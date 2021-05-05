'use strict';

define([
    'ko',
    'uiElement',
], function (ko, Element) {
    return Element.extend({
        defaults: {
            template: 'Magento_Catalog/input-counter'
        },
        initObservable: function () {
            this._super()
                .observe('qty');

            return this;
        },
        decreaseQty: function() {
            var qty = Number(this.qty()) - 1;
            this.changeQty(qty);
        },

        increaseQty: function() {
            var qty = Number(this.qty()) + 1;
            this.changeQty(qty);
        },
        changeQty: function(newVal) {
            if(newVal <= 0){
                this.qty(1);
            }else if(newVal >= this.max){
                this.qty(this.max);
                document.getElementsByClassName('stock-amount')[0].style = 'color: red; font-weight: 600';
            }else{
                this.qty(newVal);
            }
        }
    });
});
