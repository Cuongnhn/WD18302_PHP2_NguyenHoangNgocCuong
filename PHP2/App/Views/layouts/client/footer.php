</div><!-- /#right-panel -->

    <!-- Right Panel -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="<?= APP_URL?>public/assets/vendors/jquery/dist/jquery.min.js"></script>
    <script src="<?= APP_URL?>public/assets/vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="<?= APP_URL?>public/assets/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?= APP_URL?>public/assets/js/main.js"></script>


    <script src="<?= APP_URL?>public/assets/vendors/chart.js/dist/Chart.bundle.min.js"></script>
    <script src="<?= APP_URL?>public/assets/js/dashboard.js"></script>
    <script src="<?= APP_URL?>public/assets/js/widgets.js"></script>
    <script src="<?= APP_URL?>public/assets/vendors/jqvmap/dist/jquery.vmap.min.js"></script>
    <script src="<?= APP_URL?>public/assets/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <script src="<?= APP_URL?>public/assets/vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script>
        (function ($) {
            "use strict";

            jQuery('#vmap').vectorMap({
                map: 'world_en',
                backgroundColor: null,
                color: '#ffffff',
                hoverOpacity: 0.7,
                selectedColor: '#1de9b6',
                enableZoom: true,
                showTooltip: true,
                values: sample_data,
                scaleColors: ['#1de9b6', '#03a9f5'],
                normalizeFunction: 'polynomial'
            });
        })(jQuery);

        function updateData(option) {
        const dataList = document.getElementById('dataList');
        const items = dataList.getElementsByTagName('li');

        for (let i = 0; i < items.length; i++) {
        const item = items[i];
        const text = item.querySelector('div.text-muted').textContent;
        const strong = item.querySelector('strong');
        const progress = item.querySelector('.progress-bar');

      // Update data based on the selected option
        switch (option) {
            case 'day':
            if (text === 'lượt truy cập') {
                strong.textContent = '10.000 Người dùng (30%)';
                progress.style.width = '30%';
                progress.setAttribute('aria-valuenow', '30');
            } else if (text === 'Số lượt xem trang') {
                strong.textContent = '50.000 Lượt xem (70%)';
                progress.style.width = '70%';
                progress.setAttribute('aria-valuenow', '70');
            }
            // Update other items accordingly
            break;

            case 'month':
            if (text === 'lượt truy cập') {
                strong.textContent = '29.703 Người dùng (40%)';
                progress.style.width = '40%';
                progress.setAttribute('aria-valuenow', '40');
            } else if (text === 'Số lượt xem trang') {
                strong.textContent = '78.706 Lượt xem (60%)';
                progress.style.width = '60%';
                progress.setAttribute('aria-valuenow', '60');
            }
            // Update other items accordingly
            break;

            case 'year':
            if (text === 'lượt truy cập') {
                strong.textContent = '50.000 Người dùng (60%)';
                progress.style.width = '60%';
                progress.setAttribute('aria-valuenow', '60');
            } else if (text === 'Số lượt xem trang') {
                strong.textContent = '100.000 Lượt xem (80%)';
                progress.style.width = '80%';
                progress.setAttribute('aria-valuenow', '80');
            }
            // Update other items accordingly
            break;
        }
        }
    }
    </script>

</body>

</html>