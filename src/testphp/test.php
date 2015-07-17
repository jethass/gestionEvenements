<?php 
class SmsActeOptions 
{
    public $codeTemplate=1;
    public $idOption=9;
    public $idOptionGroup=5;
}


class ActeOptionsSerializer{

	public function serialize(SmsActeOptions $options){
		$a=get_object_vars($options);   // prend un objet => retourne un tableau
		$b=http_build_query($a);	   // prend un tableau retourne une query http "key=value&key2=value2"
		return $b;
	}

	public function unserialize($serializedOptions,$acteOptionsClassname){
		
		
		parse_str($serializedOptions, $options);   //prend une query http le transforme en tableau
        
        $acteOptions = new $acteOptionsClassname();  //initialisation de notre objet
        foreach ($options as $key => $value) {  //parcour le tableau
            if (!property_exists($acteOptionsClassname, $key)) {  // vérifi si le cle de tableau sont des attribut dans notre classe de notre objet
                throw new \InvalidArgumentException(
                    sprintf(
                        'property "%s" does not exist in "%s"',
                        $key,
                        $acteOptionsClassname
                    )
                );
            }

            $acteOptions->$key = $value; //création de l'objet a partir de tableau
        }

        return $acteOptions;
        
	}


}

var_dump(new SmsActeOptions());

var_dump(get_object_vars(new SmsActeOptions()));

$do=new ActeOptionsSerializer();

$optionsserialized=$do->serialize(new SmsActeOptions());
var_dump($optionsserialized);

parse_str($optionsserialized, $options);
var_dump($options);

$optionsunserialized=$do->unserialize($optionsserialized,'SmsActeOptions');
var_dump($optionsunserialized);



