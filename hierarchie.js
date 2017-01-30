<html>

<head>
<script>


function N1() {
    this.N1name = 'N1nom';
    this.N1dept = 'N1dept';
}

function N2() {
    this.N2base = N1;
    //this.N2base(nom, dept);
    //this.N2projets=projs || [];
}
N2.prototype= new N1;

/*function N3(nom, projs, moteur) {
    this.N3base = N2;
    this.N3base(nom, "ingenierie", projs);
   //this.dept = "ingenierie";
    this.moteur=moteur || "";
}
N3.prototype = new N2;*/
//var jeanne = new N3("Jeanne Dubois", ["navigateur", "javascript"], "carnot");
N = new N2;
console.log("N1name: "+N.N1name)+"\n";
/*console.log("Dept: "+jeanne.dept)+"\n";
console.log("Projet: "+jeanne.projets)+"\n";
console.log("Moteur: "+jeanne.moteur)+"\n";*/

</script>
</head>
<body>
</body>
</html>