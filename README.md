# Test Hublo

## Stack

- Symfony 5.4
- VueJS 2.7

Pour faciliter la lecture du code et du test, le front et le back cohabitent au sein d'un seul et même projet.

## API

Afin de rester sur une structure simple, j'ai utilisé FOSRest pour gérer la couche API.
APIPlatform est très efficace, mais adapté à une plus grande complexité, notamment la sécurité, la normalisation et l'exposition d'entités, ce que l'on a pas ici.

Pour invoquer l'API Reqres, j'ai utilisé ma propre librairie (derrière le namespace App\Library\Artcustomer\ApiUnit) qui permet de créer des connecteurs API et simplifier les requêtes. Il fonctionne ici avec Curl, mais il s'appuie sur un design abstrait, permettant ainsi d'utiliser Guzzle ou tout autre système permettant de d'appeler des ressources externes.

L'API est exposé derrière le chemin /api.

## Front-end

L'ensemble des éléments et actions sont rendus sur une seule et même page dynamique.

La gestion de Vue se fait avec l'aide de Webpack Encore et Stimulus bridge.

Les appels API sont exécutés avec la librairie Axios.

Bootstrap 5 est chargé en cdn afin d'ajouter du style aux éléments HTML.