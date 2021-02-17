# TheBar

## Symfony (PHP) Playground

→ Made for an HETIC course

See setup infos & course's instructions [here](https://github.com/Antoine07/hetic_symfony/blob/main/Introduction/tp_02_days.md)

## Group 5

- AGNAN Pierre-Alain
- TAPIA Rodrigo
- BEN KEBAIER Selima
- EVANO Thomas
- MARQUAND Camille

## Part 4 (exercise)

Explain (in french) this method :

```php
public function findCatSpecial(int $id)
    {
1        return $this->createQueryBuilder('c')
2            ->join('c.beers', 'b') // raisonner en terme de relation
3            ->where('b.id = :id')
4            ->setParameter('id', $id)
5            ->andWhere('c.term = :term')
6            ->setParameter('term', 'special')
7            ->getQuery()
8            ->getResult();
    }
```

Une bière a une catégorie `normal` et une ou plusieurs catégories `special`.

La fonction `findCatSpecial()`, prend en argument l'`id` d'une bière et retourne la ou les catégories `special` de cette bière.

- Ligne 1 : Construction de la requête sur la table `category` dont l'alias donné est `c`.
- Ligne 2 : Jointure entre les tables `category` et `beer` en passant implicitement sur la table `beer_category` (cachée par l'orm).
  → Les tables `category` et `beer` ayant une relation ManyToMany.
- Ligne 3 + 4 : Filtre sur l'`id` de la bière.
- Ligne 5 + 6 : Filtre sur le `term special` de la `category`.
- Ligne 7 : Construction de la query.
- Ligne 8 : Execution de la query.

## Stack used

- PHP, Symfony framework
- Twig templates
- Scss styling syntax, Bootstrap style library

## Recommended vscode extentions

- [Format HTML in PHP](https://marketplace.visualstudio.com/items?itemName=rifi2k.format-html-in-php)
- [PHP Intelephense](https://marketplace.visualstudio.com/items?itemName=bmewburn.vscode-intelephense-client)
- [Twig Language 2](https://marketplace.visualstudio.com/items?itemName=mblode.twig-language-2)

## Set up working environment

### Lauch local server

```
symfony server:start
```

### Compile

Install dependancies

```
 npm i
```

Compile assets once

```
 npm run dev
```

Compile assets automatically

```
npm run watch
```

Build

```
npm run build
```
