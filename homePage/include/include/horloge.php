<div class="card mb-4">
        <div class="card-body fond-horloge" id="horloge" style="font-size:20px;">
    </div>
    <script type="text/javascript">
        function afficherDate() 
            {
                let cejour = new Date();
                let options = {weekday: "long", year: "numeric", month: "long", day: "2-digit"};
                let date = cejour.toLocaleDateString("fr-FR", options);
                let heure = ("0" + cejour.getHours()).slice(-2) + ":" + ("0" + cejour.getMinutes()).slice(-2) + ":" + ("0" + cejour.getSeconds()).slice(-2);
                let dateheure = date + "<br> " + heure;
                dateheure = dateheure.replace(/(^\w{1})|(\s+\w{1})/g, lettre => lettre.toUpperCase());
                document.getElementById('horloge').innerHTML = dateheure;
            }
        setInterval(afficherDate, 1000);
    </script>
</div>