/**
 * This file is part of Alchemy exercise 2
 */

alchemy = {};

(function()
{ // début de scope local

    alchemy.Authentication = function(pParm)
    {


    };

    alchemy.Authentication.prototype =
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

            var buttonSign = document.querySelector('.btn-signin');
            buttonSign.addEventListener('click', function(){refThis.handleButtonSignClick(this)}, false);
        },

        handleButtonSignClick : function(pHTMLElement)
        {
            var firstname = document.querySelector('#inputFirstName').value;
            var name = document.querySelector('#inputName').value;

           // $('#myModal').modal('show');
            this.login(firstname, name);

            if (pHTMLElement.preventDefault) pHTMLElement.preventDefault();
            pHTMLElement.returnValue=false;
        },

        login : function(pFirstName, pName)
        {
            var ajaxLoader = aja;
            ajaxLoader()
                .url('')
                .method('post')
                .data({action: 'auth', firstname : pFirstName, name : pName})
                .on('success', function(dataJSON)
                {
                    if(dataJSON['state'] === false)
                    {
                        $('#myModal').modal('show');
                    }
                    else
                    {
                        location.reload();
                    }

                })
                .on('40x', function(response)
                {
                    alert('Update product amount error.');

                })

                .go();
        },
        version : 1
    };

})(); // fin de scope local



var authentication = new alchemy.Authentication();
authentication.waitDOMLoaded();


