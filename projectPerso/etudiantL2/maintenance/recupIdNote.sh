#! /bin/bash

f1=$1

cat $f1 | sed -e"s/;\">/\nDEBUT-/g" -e"s/<\/span>/\nFIN/g" >tpA_clean.txt

cat tpA_clean.txt | grep "^DEBUT-" | cut -d'-' -f2 | sed -e"s/,/./g" > tpA_note_clean.csv

cat tpA_note_clean.csv
