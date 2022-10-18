#!/bin/bash
if [ $# -eq 0 ]
  then
    echo "No arguments supplied\ncorrect commond sh mock.sh s4xxxxxxx zone-id \ne.g. sh mock.sh s4123456 9933d758"
     exit 1
fi
echo 'create Quiz Folder'
cd /var/www/htdocs/
apt-get install --no-install-recommends --no-install-suggests -q -y zip wget
rm -rf /var/www/htdocs/mock
mkdir mock
cd mock
wget --no-check-cert https://www.dropbox.com/s/th3ni63bv2l3xgu/Mock.zip
unzip Mock.zip
rm Mock.zip
echo 'Setting Quiz Environment'
sudo sed -i 's/#default         \"allow\:user\:\*\"/default             \"allow\:user\:\*\" /g' /etc/nginx/conf.d/auth.conf
sudo sed -i 's/default          \"allow\:\*\"/#default          \"allow\:\*\"/g' /etc/nginx/conf.d/auth.conf
sudo sed -i '/location \/infs3202_quiz1 /,+4d' /etc/nginx/frameworks-enabled/php.conf
sudo sed -i 's/index index.php index.htm index.html;/index index.php index.htm index.html;\n\nlocation \/mock {\n\t try_files \$uri \$uri\/ \/mock\/index.php;\n\t index index.php;\n}/g' /etc/nginx/frameworks-enabled/php.conf 
sudo systemctl reload nginx
echo 'Enable VSCode'
sudo webprojctl enable vscode
echo 'systemctl enable code-server@'$1
echo 'Mock has setup properly'