# chesspgn

Application web simple pour :

- saisir des parties via échiquier + formulaire,
- éditer le PGN (avec variantes manuelles),
- stocker / lister / modifier / supprimer des parties dans Back4App (Parse),
- exporter les parties au format `.pgn`,
- partager publiquement une partie via un lien `?share=<objectId>`.

## Démarrage

1. Ouvrir `index.html` dans le navigateur.
2. Renseigner `App ID`, `JavaScript Key` et `Server URL` de Back4App.
3. Créer un compte ou se connecter.
4. Sauvegarder des parties dans la classe Parse `ChessGame`.

## Notes variantes PGN

Le textarea PGN accepte les variantes (parenthèses) en édition manuelle.
Le bouton **Insérer variante** ajoute rapidement `(<variante>)` à la position du curseur.

> Limitation: `chess.js` charge surtout la ligne principale et peut ne pas relire entièrement des PGN avec variantes complexes.
