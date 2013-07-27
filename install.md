To install AllianceCMS in your root domain (www.mysite.com)

1. Upload Folders and Files
    * Place the contents of 'public_html' into your web server's 'Document Root' folder (commonly named 'public_html' or 'htdocs')
    * Place the 'axis' and 'zones' folders on level up from your web server's 'Document Root' folder
2. Use your web browser and navigate to your domain (i.e. http://www.yourdomain.com)
3. Install AllianceCMS by following the instructions and hints provided by AllianceCMS's installer
4. Check out the AllianceCMS Wiki for terminology explanations

To install AllianceCMS on a subdomain domain (docs.mysite.com)

1. Upload/Create Folders and Files
    * Place the contents of 'public_html' into your 'subdomain' folder (i.e. /public_html/docs)
    * Place the 'axis' and 'zones' folders on level up from your web server's 'Document Root' folder (SECURITY RISK: Never place these files where you can access them from a web client!)
    * Make a copy of '/zones/default' and rename the copy to match the address of your subdomain, with out the 'http(s)://' (i.e. docs.mysite.com)
        * Make sure you delete 'dbConnections.php' if it already exists
2. Open '/subdomain/index.php' and follow the instructions there (you may have to adjust depending on folder structure)
4. Use your web browser and navigate to your subdomain (i.e. http://docs.yourdomain.com)
5. Install AllianceCMS by following the instructions and hints provided by AllianceCMS's installer
6. Check out the AllianceCMS Wiki for terminology explanations
