
$(function(){
    $('.calculate').on('keyup', function(){
        const name = $(this).attr('name');
        const currentInput = $(this).attr('id');
    
        const price = parseFloat( document.querySelector(`#${name}Price`).value ); 
      
        const currentValue = parseFloat(document.querySelector(`#${currentInput}`).value) || 0; 

        $(this).attr('calculated', price * currentValue);
          
        let totalCommission = 0;

        const arrayInp = $('.calculate');
        for(let i=0; i< arrayInp.length; i++){
            totalCommission += parseFloat( arrayInp[i].getAttribute('calculated'));
        }
        
        document.querySelector('#commission').value = totalCommission;
        document.querySelector('#commission2').value = totalCommission;
        
        // console.log('calling to calculate function..');
    
    });
});
