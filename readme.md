# Visualisation de Données Liées

Par Quentin Giraud (giraudqg@gmail.com)

## Explications

Le code de ce projet peut être divisé en trois parties :

### 1 - Récupération des données

Via un curl en PHP, je récupère les données de l'url dans la variable $return que j'ai construit à partir de l'ID soumis par l'utilisateur.


### 2 - Construction du graphe RDF

Avec la librairie PHP EasyRDF, je construit le graphe RDF auxquel je fournis l'URI du document construit auparavant, les données récupérées par le curl et le format correspondant à ces données, ici turtle

### 3 - Extraction des données du graphe RDF

Le graphe contenu dans la variable, j'extrait les objets contenant le titre, la date et les auteurs en fournissant le sujet ( l'URI précédemment construit ) et le prédicat ( "dcterms:title", "dcterms:date", "dcterms:creator").
Par la suite j'affiche les valeurs avec un echo. Pour chaque auteur récupéré, je récupère le nom en indiquant que la ressource récupéré correspond à l'ontologie FOAF.