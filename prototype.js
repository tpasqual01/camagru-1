<script>
function Player(){
	this.name;
	this.points = 100;
	this.attack = function attack(adv) { adv.points -= 10; this.points += 10; alert(this.name+" prend "+adv.name);}
}

var p1 = new Player();
var p2 = new Player();

p1.name = 'dominique';
p2.name = 'thierry';

p1.attack(p2);
alert(p1.name+' a '+p1.points+" et "+p2.name+" a "+p2.points);
