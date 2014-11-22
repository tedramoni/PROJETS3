PROJETS3
========

PROJET S3 INFO - IUT VELIZY - GESTION COMMERCIALE

I – Introduction 
II – Énoncé 
III – Pré-requis 
IV – Priorités 

I – Introduction :

Ce projet consiste en la création d'une application qui permettra la gestion commerciale de
l'entreprise Ikonic. Cette société est spécialisée dans la vente de solutions de vidéo-surveillance, et
elle a besoin de cette application pour pouvoir simplifier le processus de vente et coordonner les
tâches des différents services de la société, à savoir le service commercial, le service d'achat, la
comptabilité ainsi que l'entrepôt.

II – Énoncé :

Cette application se présentera sous la forme d'un site internet. Pour le client, le site sera
simplement une vitrine qui présente les produits proposés par la société, sans mentionner de prix ni
de formulaire de commande. Le client devra passer commande auprès de la société Ikonic pour se
procurer les produits voulus.
Il y aura 4 types de comptes utilisateur, correspondant aux différentes fonctions dans l'entreprise :

– Achat
– Commercial
– Entrepôt
– Comptabilité

Un compte « administrateur » aura accès aux fonctionnalités offertes à tous les autres utilisateurs.

L'utilisateur devra entrer ses identifiants sur le site internet pour accéder à l'application.
Elle permettra à un utilisateur « achat » de renseigner les articles achetés (ajouter du stock de
produits existants, créer de nouveaux produits à vendre), et à un utilisateur « commercial » de créer
les comptes clients. Il y aura donc une base de données pour les articles, et une pour les clients.
Lorsqu'un client contacte la société pour une commande, l'utilisateur « commercial » peut demander
à créer un compte client s'il n'en existe pas, dans ce cas il entrera les informations nécessaires. Il
utilisera un compte déjà existant « client non enregistré » le cas échéant.

L'utilisateur « commercial » consulte le stock de produits voulus par le client, il s'assure que la
quantité est suffisante et valide si c'est le cas, sinon il le notifiera au client, qui agira en
conséquence.
Après validation, l'utilisateur « entrepôt » reçoit ces informations, et génère un bon de livraison
lorsque le produit est expédié. Le bon de livraison sera ensuite imprimé et joint au colis.
L'utilisateur « comptabilité » se chargera de la facturation. Il pourra générer une facture à partir du
bon de livraison à l'aide d'un simple bouton, mais pourra aussi créer lui-même la facture en entrant
les informations nécessaires (définies dans la spécification). Il définira en particulier l'échéance de
la facture, et pourra modifier le prix unitaire et la remise faite au client.
Lors de la sauvegarde de la facture, le stock d'objets doit être automatiquement mis à jour, on peut
aussi annuler la facture.
Les bons de livraison et les factures seront sauvegardées, et consultables par les différents
utilisateurs.
Les clients disposeront d'un historique de leurs commandes, les articles auront également un
historique des entrées/sorties. Ces historiques pourront être affichés pour différentes périodes.

III – Pré-requis :

Vous devrez utiliser un système d'exploitation quelconque, pour pouvoir coder votre application
dans un langage de programmation web adapté (le PHP est conseillé), associé à un SGBD (tel que
MySQL).

IV – Priorités :

Pour janvier 2015, vous devrez livrer une application qui permettra simplement la gestion de la base
de données des articles, ainsi que la gestion la base de données des clients, avec le dossier associé.
Le livrable pourra comporter uniquement le compte « administrateur », sans se soucier des
différents problèmes de droits d'accès.
Puis, pour Mai 2015, vous devrez terminer l'application telle que décrite dans l'énoncé, et remettre
le dossier complet de l'application
