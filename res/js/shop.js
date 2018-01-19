alchemy = {};

(function()
{ // début de scope local

    alchemy.Shop = function(pParm)
    {


    };

    alchemy.Shop.prototype =
    {
        waitDOMLoaded : function()
        {
            var refThis = this;
            document.addEventListener("DOMContentLoaded", function(pEvent)
            {
                refThis.init();
            });
        },

        init : function()
        {
            var refThis = this;

            /**
             * Add click event on '.less' class button
             * @type {NodeList}
             */
            var list = document.querySelectorAll('.btnless');
            for(var i=0;i<list.length;i++)
            {
                /** @type {HTMLElement} */
                var buttonLess = list[i];
                var id = this.getDataAttributes(buttonLess, 'id');
                buttonLess.addEventListener('click', function(){refThis.handleButtonLessClick(this)}, false);
            }

            /**
             * Add click event on '.more' class button
             * @type {NodeList}
             */
            var list = document.querySelectorAll('.btnmore');
            for(var i=0;i<list.length;i++)
            {
                /** @type {HTMLElement} */
                var buttonMore = list[i];
                var id = this.getDataAttributes(buttonMore, 'id');
                buttonMore.addEventListener('click', function(){refThis.handleButtonMoreClick(this)}, false);
            }

            /**
             * Add change keypress on '.amount' class input
             * @type {NodeList}
             */
            var list = document.querySelectorAll('input.amount');
            for(var i=0;i<list.length;i++)
            {
                /** @type {HTMLElement} */
                var inputAmout = list[i];
                inputAmout.addEventListener('keypress', function(pEvt){refThis.handleInputKeypress(pEvt, this)}, false);
            }

            /**
             * Add change event on '.amount' class input
             * @type {NodeList}
             */
            var list = document.querySelectorAll('input.amount');
            for(var i=0;i<list.length;i++)
            {
                /** @type {HTMLElement} */
                var inputAmout = list[i];
                inputAmout.addEventListener('change', function(pEvt){refThis.handleInputValueChanged(this.id.substr(1))}, false);
            }
        },

        handleButtonLessClick : function(pHTMLElement)
        {
            var id = this.getDataAttributes(pHTMLElement, 'id');
            this.setNewQuantity(id, -1);
        },
        handleButtonMoreClick : function(pHTMLElement)
        {
            var id = this.getDataAttributes(pHTMLElement, 'id');
            this.setNewQuantity(id, 1);
        },
        setNewQuantity : function(pId, pDiff)
        {
            var inputField = document.querySelector('#_'+pId);
            inputField.value = inputField.value * 1 + pDiff;
            this.handleInputValueChanged(pId);
        },
        handleInputKeypress : function(pEventKeypress, pHTMLElement)
        {
            var id = this.getDataAttributes(pHTMLElement, 'id');
            this.isNumericKeyPressed(pEventKeypress);
        },
        isNumericKeyPressed : function(e)
        {
            var chrTyped, chrCode=0, evt=e?e:event;
            if (evt.charCode!=null)     chrCode = evt.charCode;
            else if (evt.which!=null)   chrCode = evt.which;
            else if (evt.keyCode!=null) chrCode = evt.keyCode;

            if (chrCode==0) chrTyped = 'SPECIAL KEY';
            else chrTyped = String.fromCharCode(chrCode);

            //[test only:] display chrTyped on the status bar
            self.status='inputDigitsOnly: chrTyped = '+chrTyped;

            //Digits, special keys & backspace [\b] work as usual:
            if (chrTyped.match(/\d|[\b]|SPECIAL/)) return true;
            if (evt.altKey || evt.ctrlKey || chrCode<28) return true;

            //Any other input? Prevent the default response:
            if (evt.preventDefault) evt.preventDefault();
            evt.returnValue=false;
            return false;
        },

        handleInputValueChanged : function(pId)
        {
            var inputField = document.querySelector('#_'+pId);
            var inputFieldValue = inputField.value * 1;

            if(inputFieldValue < 0)
            {
                inputField.value = 0;
            }
            if(inputFieldValue > 999999)
            {
                inputField.value = 999999;
            }

            this.updateProductAmount(pId, inputField.value);
        },
        updateProductAmount : function(pId, pAmount)
        {
            var ajaxLoader = aja;
            ajaxLoader()
                .url('')
                .method('post')
                .data({action: 'updateAmount', id : pId, amount : pAmount})
                .on('success', function(dataJSON)
                {

                })
                .on('40x', function(response)
                {
                    alert('Update product amount error.');

                })

                .go();
        },
        /**
         * Return value for data attribut "data-"
         * Failback for old browser include.
         *
         * @usage getDataAttributes(this.elt, 'list-size');
         * @param {DOM object} pElement
         * @param {string} pAttributes
         * @returns {*}
         */
        getDataAttributes : function(pElement, pAttributes)
        {
            pAttributes = pAttributes.toLowerCase();

            var tmp = pAttributes.split("-");
            for(var n=1; n<tmp.length; n++)
            {
                tmp[n] =  tmp[n].charAt(0).toUpperCase() + tmp[n].slice(1);
            }
            var attribute = tmp.join('');

            out = pElement.dataset[attribute];

            if(typeof out !== "undefined")
            {
                return(out);
            }

            /*
             * FailBack for older browsers
             */
            return(pElement.getAttribute["data-"+pAttributes]);
        },



        version : 1
    };

})(); // fin de scope local



var shop = new alchemy.Shop();
shop.waitDOMLoaded();


