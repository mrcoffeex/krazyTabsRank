<?php  
    //put alerts here
    $currpage = str_replace('.php', '', basename($_SERVER['PHP_SELF']));

    $note = @$_GET['note'];

    if ($note == "error") {
        echo "
            <script>
                toastr.error('Error');
            </script>
        ";
    } else if ($note == "invalid") {
        echo "
            <script>
                toastr.error('Invalid');
            </script>
        ";
    } else if ($note == "account_updated") {
        echo "
            <script>
                toastr.success('Account information updated');
            </script>
        ";
    } else {

        if ($currpage == "index") {
            
            if ($note == "noexist") {
                echo "
                    <script>
                        toastr.error('Either username or password is incorrect');
                    </script>
                ";
            } else {
                echo "";
            }
            
        }
        
        if ($currpage == "users") {
            
            if ($note == "user_added") {
                echo "
                    <script>
                        toastr.success('User has been added');
                    </script>
                ";
            } else if ($note == "user_updated") {
                echo "
                    <script>
                        toastr.success('User has been added');
                    </script>
                ";
            } else if ($note == "user_deactivate") {
                echo "
                    <script>
                        toastr.success('User has been deactivated');
                    </script>
                ";
            } else if ($note == "user_activate") {
                echo "
                    <script>
                        toastr.success('User has been activated');
                    </script>
                ";
            } else if ($note == "username_exists") {
                echo "
                    <script>
                        toastr.error('Username already exists. Please try another username.');
                    </script>
                ";
            } else {
                echo "";
            }
            
        }

        if ($currpage == "events") {
            
            if ($note == "event_deleted") {
                echo "
                    <script>
                        toastr.success('Event has been deleted');
                    </script>
                ";
            } else if ($note == "mismatch") {
                echo "
                    <script>
                        toastr.error('Password mismatched');
                    </script>
                ";
            } else {
                echo "";
            }

        }

        if ($currpage == "event_create_form") {
            
            if ($note == "event_added") {
                echo "
                    <script>
                        toastr.success('Event has been added');
                    </script>
                ";
            } else {
                echo "";
            }

        }

        if ($currpage == "event_update_form") {
            
            if ($note == "event_updated") {
                echo "
                    <script>
                        toastr.success('Event has been updated');
                    </script>
                ";
            } else {
                echo "";
            }

        }

        if ($currpage == "event_judges") {
            
            if ($note == "judge_added") {
                echo "
                    <script>
                        toastr.success('Judge has been added');
                    </script>
                ";
            } else if ($note == "judge_updated") {
                echo "
                    <script>
                        toastr.success('Judge has been updated');
                    </script>
                ";
            } else if ($note == "username_exists") {
                echo "
                    <script>
                        toastr.error('Username already exists. Please try another username.');
                    </script>
                ";
            } else if ($note == "empty") {
                echo "
                    <script>
                        toastr.error('No judge selected.');
                    </script>
                ";
            } else if ($note == "judge_transfer") {
                echo "
                    <script>
                        toastr.success('Judges has been transfered.');
                    </script>
                ";
            } else {
                echo "";
            }

        }

        if ($currpage == "event_candidates") {
            
            if ($note == "can_added") {
                echo "
                    <script>
                        toastr.success('Candidate has been added');
                    </script>
                ";
            } else if ($note == "can_updated") {
                echo "
                    <script>
                        toastr.success('Candidate has been updated');
                    </script>
                ";
            } else if ($note == "can_deleted") {
                echo "
                    <script>
                        toastr.success('Candidate has been deleted');
                    </script>
                ";
            } else if ($note == "can_duplicate") {
                echo "
                    <script>
                        toastr.error('Candidate number has been taken');
                    </script>
                ";
            } else if ($note == "has_record") {
                echo "
                    <script>
                        toastr.error('Candidate has existing record. Cannot delete');
                    </script>
                ";
            } else if ($note == "empty") {
                echo "
                    <script>
                        toastr.error('No candidate selected');
                    </script>
                ";
            } else if ($note == "candidate_transfer") {
                echo "
                    <script>
                        toastr.success('Candidates has been transfered');
                    </script>
                ";
            } else {
                echo "";
            }

        }

        if ($currpage == "category") {
            
            if ($note == "cat_added") {
                echo "
                    <script>
                        toastr.success('Category has been added');
                    </script>
                ";
            } else if ($note == "cat_updated") {
                echo "
                    <script>
                        toastr.success('Category has been updated');
                    </script>
                ";
            } else if ($note == "cat_deleted") {
                echo "
                    <script>
                        toastr.success('Category has been deleted');
                    </script>
                ";
            } else if ($note == "cat_reset") {
                echo "
                    <script>
                        toastr.success('Reset Successful');
                    </script>
                ";
            } else {
                echo "";
            }

        }

        if ($currpage == "criteria") {
            
            if ($note == "cri_added") {
                echo "
                    <script>
                        toastr.success('Criteria has been added');
                    </script>
                ";
            } else if ($note == "cri_updated") {
                echo "
                    <script>
                        toastr.success('Criteria has been updated');
                    </script>
                ";
            } else if ($note == "cri_deleted") {
                echo "
                    <script>
                        toastr.success('Criteria has been deleted');
                    </script>
                ";
            } else {
                echo "";
            }

        }

        if ($currpage == "event_image") {
            
            if ($note == "updated") {
                echo "
                    <script>
                        toastr.success('Image has been updated');
                    </script>
                ";
            }else if ($note == "invalid_upload") {
                echo "
                    <script>
                        toastr.error('Image is invalid only accepting JPEG PNG GIF');
                    </script>
                ";
            }else{
                echo "";
            }

        }

    }
    
    
?>