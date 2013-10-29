<?php

/***
 *
 * moA implementation for Post editing system
 * Refer to the attached index.php to check any implementation details
 * Support adding/updating/deleting/retrieving records
 *  
 */

include './moa.php';

$cfg = array(
                'pid' => 'ID',
                'title' => 'Title',
                'post' => 'Post',
                'parent' => 'Parent',
                'dtime' =>  'Dtime'        
            );
$Post = new moA("posts",$cfg,"pid");

$actionClass = "index.php";

function getEditor($post = NULL){
        $estr = '<script type="text/javascript" src="editor/nicEdit.js"></script>';
        if(isset($post)){
            $estr .= '<form action="'.$actionClass.'" method="POST">
                    <input type="hidden" name="pid" value="'.$post->pid.'" />
                    Parent : <input type="text" name="parent" value='.$post->parent.'  length=2 size=2 /><br />

                    Title : <input type="text" size="50" name="title" value="'.$post->title.'" />
                    <br />
                    Post : <br />
                    <textarea style="width: 600px; height: 350px;" id="editor" name="post">'.$post->post.'</textarea><br />

                    <input type="submit" value="Update" name="update" />

                    </form>';
        }else{
            $estr .= '<form action="'.$actionClass.'" method="POST">
                    <input type="hidden" name="pid" />
                    Parent : <input type="text" name="parent" value=0  length=2 size=2 /><br />

                    Title : <input type="text" size="50" name="title" value="" />
                    <br />
                    Post : <br />
                    <textarea style="width: 600px; height: 350px;" id="editor" name="post"></textarea><br />

                    <input type="submit" value="Submit" name="new" />

                    </form>';
        }    
        $estr .= '<script type="text/javascript">
                        bkLib.onDomLoaded(function() {
                                var editor = new nicEditor({
                                        fullPanel : true,
                                        iconsPath : \'editor/nicEditorIcons.gif\',
                                        maxHeight : 400,
                                        buttonList : [\'html\']
                                        }).panelInstance(\'editor\');
                        });
                   </script>';
        
        return $estr;
    }

?>
