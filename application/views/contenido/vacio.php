<?php

?>
<body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
</body>
<script>
    <?php if($this->session->flashdata('updated')){ ?>
    Swal.fire({
        position: 'center',
        icon: 'success',
        text: '<?php echo $this->session->flashdata('updated'); ?>',
        showConfirmButton: false,
        timer: 1500
    });
    <?php } ?>
</script>