Dépôt officiel du site [tiretdubas.com](https://tiretdubas.com).

# Installation

Cet exemple d'installation est réalisé à l'aide de [Laravel Sail](https://laravel.com/docs/10.x/sail) !

Pour commencer, on peut ajouter quelques alias à notre shell (Par exemple `~/.zshrc` pour Zsh) pour plus de simplicité par la suite :

```shell
alias sail="vendor/bin/sail"
alias artisan="sail artisan"
alias art="artisan"
```

On peut ensuite passer à l'installation :

```shell
git clone git@github.com:tiretdubas/tiretdubas.com.git
cd tiretdubas.com
composer i
cp .env.example .env
php artisan sail:install # 🟩 MySQL
sail up -d
art key:generate
art migrate —seed
sail npm i
sail npm run dev
```

Rendez-vous sur [http://localhost](http://localhost) pour accéder au site !

# Licence

- Le site Web est sous [licence MIT](https://choosealicense.com/licenses/mit/).
- Le contenu [ne peut pas être réutilisé](https://choosealicense.com/no-license/) sans le consentement de son auteur.

Vous pouvez me contacter à [steven@tiretdubas.com](mailto:steven@tiretdubas.com) pour toute demande de réutilisation complète ou partielle de contenu.
