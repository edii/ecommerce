#!/usr/bin/env bash
ERR_MSG=""
clear

while :
do
	if [ "$ERR_MSG" != "" ]; then
		echo "Error: $ERR_MSG"
		echo ""
	fi

	echo ""
	echo "Select an option:"
	echo "1) Clear all cache"
    echo "2) update schema DB."
    echo "3) remove db."
    echo "4) created db."
    echo "5) load db fixtures."
    echo "6) Generate bower."
    echo "7) Run gulp."
    echo "8) Run all."

	ERR_MSG=""

	read SEL

	case $SEL in
		1) php app/console cache:clear; exit; ;;
		2) php app/console doctrine:schema:update --force; exit; ;;
		3) php app/console doctrine:database:drop --force; exit; ;;
		4) php app/console doctrine:database:create; exit; ;;
		5) php app/console doctrine:fixtures:load --append; exit; ;;
		6) cd "${SRC}./web/admin/" && bower i -g; exit; ;;
		7) cd "${SRC}./web/admin/" && gulp; exit; ;;
		8)
		    source "${SRC}./updateDB.sh";
		    php app/console cache:clear;
            cd "${SRC}./web/admin/" && gulp build;
            exit;
		    ;;
		*) ERR_MSG="Please enter a valid option!"
	esac

	clear
done