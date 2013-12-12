all: clean sort gen

clean:
	rm -rf *.html

sort: sites.json
	php sort.php

show: sites.json
	php dev.php

gen: sites.json
	php static-gen.php > /dev/null 2>&1
