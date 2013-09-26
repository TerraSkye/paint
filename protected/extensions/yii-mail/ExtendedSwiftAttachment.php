<?php
/**
 * Extended class to give a rename a file in a attachment
 * @author spasma
 */
class ExtendedSwiftAttachment extends Swift_Attachment {

	public static function fromPath($path, $contentType = null, $newFileName = null) {
		$fileByteStream = new Swift_ByteStream_FileByteStream($path);
		return self::newInstance($fileByteStream, $newFileName, $contentType);
	}

}

?>
