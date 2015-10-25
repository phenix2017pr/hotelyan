# wolf-image

Image manipulation plugin for [Wolf CMS](http://www.wolfcms.org) based on [Kohana Image](https://github.com/kohana/image).
Allows images to be resized, cropped, etc.

## Manipulate image on the fly

### Params:
* src = path to your image
* c = command to execute

### Command:
* NULL/not set = resize
* c = crop
* r = rotate
* f = flip
* s = sharpen

### Resize

#### Params
* w = width
* h = height
* d = dimension

##### dimension
* NULL = AUTO
* i = INVERSE
* n = NONE

#### Example
	http://your.domain/wolfimage?src=/path/to/your/image.jpg&w=300&h=200
	or
	<img src="/wolfimage?src=/path/to/your/image.jpg&w=300&h=200" alt="" />

### Crop

#### Params
* w = width
* h = height
* x = offset from the left
* y = offset from the top

#### Example
	http://your.domain/wolfimage?src=/path/to/your/image.jpg&c=c&w=300&h=200
	or
	<img src="/wolfimage?src=/path/to/your/image.jpg&c=c&w=300&h=200" alt="" />
	
Note the <code>c</code> param

### Rotate 

#### Params
* d = degrees to rotate <code>-360-360</code>

#### Example
	http://your.domain/wolfimage?src=/path/to/your/image.jpg&c=r&d=45
	or
	<img src="/wolfimage?src=/path/to/your/image.jpg&c=r&d=45" alt="" />
	
Note the <code>c</code> param

### Flip

### Params
* d = direction

#### direction
* h = horizontal
* NULL/any value = vertical

#### Example
	http://your.domain/wolfimage?src=/path/to/your/image.jpg&c=f&d=h
	or
	<img src="/wolfimage?src=/path/to/your/image.jpg&c=f&d=h" alt="" />
	
Note the <code>c</code> param

### Sharpen

### Params
* d = amount to sharpen <code>1-100</code>

#### Example
	http://your.domain/wolfimage?src=/path/to/your/image.jpg&c=s&d=100
	or
	<img src="/wolfimage?src=/path/to/your/image.jpg&c=s&d=100" alt="" />
	
Note the <code>c</code> param

## Installation

* Download from [here](http://devi.web.id/files/wolf-image.zip) or [github](https://github.com/devi/wolf-image).
* Copy wolf-image to <code>/path/to/wolf/plugins/</code>
* Rename folder name from wolf-image to image
* Go to administration page to enable or disable the plugin

## Changelog:

### May 17, 2011
* Create settings page
* Refactor some code

### February 9, 2011
* Update README

### v1.0.1 : January 16th, 2011
* Added simple validation for <code>params</code>
* Added crop function
* Added rotate function
* Added flip function
* Added sharpen function
* Added image mime check <code>jpg, jpeg, gif and png</code>
* change url request from <code>image</code> to <code>wolfimage</code>

### v1.0.0 : January 14th, 2011 
* Initial release
* Added resize image on the fly

## TODO
* Combine command (ex. resize + rotate)
* Caching

## License:

Major components:

* Wolf CMS: GPLv3 license
* Kohana: BSD license

Everything else:

* [The Unlicense](http://unlicense.org) (aka: public domain)
