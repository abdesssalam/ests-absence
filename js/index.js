
$(document).ready(function(){
   
    $('#btn_add_person').click(function(e){
        e.preventDefault();
        var nom=$('input[name="nom"]').val();
        var prenom=$('input[name="prenom"]').val();
        console.log(nom)
        console.log(prenom)
        $.get('db/absence.xml',function(dt,st){
            console.log(st);
            var persons=dt.querySelector('persons');
            persons.append(add_person(nom,prenom));

        })
    });

    function get_xml_db(){
        $.ajax({
            type: "GET",
            url: "db/absence.xml",
            dataType: "xml",
            success: function(xml) {
                $(xml).find('person')
            },
            //other code
            error: function() {
            console.log("The XML File could not be processed correctly.");
            }
            });
    }
    function add_person(nom,pernom){
        return `<person><nom>${nom}</nom><prenom>${pernom}</prenom></person>`;
    }
})