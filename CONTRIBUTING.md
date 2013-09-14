#Contributing

**Please do not edit any of the static pages (anything.html). These are generated when we deploy.**

The sites, urls and additional notes are stored in `sites.json`. If you want to add a site to the list you'll need the following information:

- `name`: The name of the service
- `url`: The url that account deletion resides. If such a page doesn't exists, the url should be a contact or help page explaining the process of account deletion.
- `difficulty`: This is an indicator used on the site to determine the difficulty of account deletion:
	- `easy`: Sites with a simple process such as a 'delete account' button
	- `medium`: Sites that do allow account deletion but require you to perform additional steps
	- `hard`: Sites that require you to contact customer services or those that don't allow automatic or easy account deletion
	- `impossible`: For sites where it's basically impossible to totally delete your account, even if you contact them
- `notes`: *(optional)* Notes will be shown when someone hovers on that service. Notes may include additional information you might need to delete your account (e.g. Skype) or consequences of deleting your account (e.g. iTunes).
- 'email': *(optional)* If you have to send an email to a company to cancel your account, add the email address here. We'll do the rest.

##Contribution checklist

1. Have you updated to the lastest version of the project? `git pull`
2. If you have modified an existing service's difficulty, please explain why/give sources.
3. URLs must be direct links to either deletion, or if this is not available, a relevant help article.
4. Any steps for the process should be detailed in the notes (if necessary).
5. Be sure to indent 4 spaces per level.
6. Be sure to place your entry ALPHABETICALLY in the current list.
7. Please test that your changes work by going to `localhost` or `localhost/index.php`

##Translation

If you want to translate the site see #164 and #165