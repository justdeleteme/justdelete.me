JustDelete.me
=============

A directory of links where you can delete your account from web services. Live on the interwebz at http://justdelete.me (see what we did there?)

## Contributing a site

The sites, URLs and additional notes are stored in `sites.json`. If you want to add a site to the list you'll need the following information:

- `name`: The name of the service
- `url`: The URL where the service account deletion functionality resides. If such a page doesn't exist, the URL should be a contact or help page explaining the process of account deletion.
- `difficulty`: This is an indicator used on the site to determine the difficulty of account deletion:
	- `easy`: Sites with a simple process such as a 'delete account' button
	- `medium`: Sites that do allow account deletion, but require you to perform additional steps
	- `hard`: Sites that require you to contact customer services or those that don't allow account deletion easily, if at all (e.g. Netflix)
- `notes`: (optional) This is primarily for sites listed as `hard`, but will also be displayed for `easy` or `medium` too. The notes will be shown when someone hovers on that service. Notes may include additional information you might need to delete your account (e.g. Skype) or consequences of deleting your account (e.g. iTunes).

Simply fork this repo, add the site to `sites.json` and submit a pull request. Simples.

Search functionality modified from [DevCenter.me](https://github.com/stevestreza/DevCenter.me).