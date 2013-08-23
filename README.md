JustDelete.me
=============

A directory of direct links to delete your account from web services.

##Contributing a site

The sites, urls and additional notes are stored in `sites.json`. If you want to add a site to the list you'll need the following information:

- `name`: The name of the service
- `url`: The url that account deletion resides. If such a page doesn't exists, the url should be a contact or help page explaining the process of account deletion.
- `difficulty`: This is an indicator used on the site to determine the difficulty of account deletion:
	- `easy`: Sites with a simple process such as a 'delete account' button
	- `medium`: Sites that do allow account deletion but require you to perform additional steps
	- `hard`: Sites that require you to contact customer services or those that don't allow automatic or easy account deletion
	- `impossible`: For sites where it's basically impossible to totally delete your account, even if you contact them
- `notes`: (optional) This is for sites listed as `hard`. Notes will be shown when someone hovers on that service. Notes may include additional information you might need to delete your account (e.g. Skype) or consequences of deleting your account (e.g. iTunes).

Simply fork this repo, add the site to `sites.json` and submit a pull request. Simples.

Search functionality modified from [DevCenter.me](https://github.com/stevestreza/DevCenter.me).
