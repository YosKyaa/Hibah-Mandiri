if (row.statuses.id === 'S06') {
                                html +=
                                    `<a class="badge badge-center rounded-pill bg-success" title="Telah Presentasi" style="cursor:pointer" onclick="mark_as_presented(\'` +
                                    row.id +
                                    `\')"><i class="bx bx-check" style="color:#ffff"></i></a>`;
                            } else if (row.mark_as_revisioned_2) {
                                html +=
                                    `<a class="badge badge-center rounded-pill bg-warning" title="Show" href="{{ url('reviewer/show/${row.id}') }}"><i class="bx bx-show" style="color:#ffff"></i></a>
                                    <a class="badge badge-center rounded-pill bg-success" title="Presentasi" style="cursor:pointer" onclick="presentasi(\'${row.id}\')"><i class="bx bx-check" style="color:#ffff"></i></a>
                                    `;
                            } else if (row.statuses.id === 'S05' || row.statuses.id === 'S07' || row
                                .statuses.id === 'S03' || row.statuses.id === 'S04' || row.statuses
                                .id === 'S08' || row.statuses.id === 'S09' || row.statuses.id ===
                                'S10') {
                                html +=
                                    `<a class="badge badge-center rounded-pill bg-warning" title="Show" href="{{ url('reviewer/show/${row.id}') }}"><i class="bx bx-show" style="color:#ffff"></i></a>`;
                            } else if (row.mark_as_revised_2) {
                                html +=
                                    `<a class="badge badge-center rounded-pill bg-warning" title="Show" href="{{ url('reviewer/show/${row.id}') }}"><i class="bx bx-show" style="color:#ffff"></i></a>
                                    <a class="badge badge-center rounded-pill bg-success" title="Presentasi" style="cursor:pointer" onclick="presentasi(\'${row.id}\')"><i class="bx bx-check" style="color:#ffff"></i></a>`;
                            } else if (row.mark_as_revised_1) {
                                html +=
                                    `<a class="badge badge-center rounded-pill bg-warning" title="Show" href="{{ url('reviewer/show/${row.id}') }}"><i class="bx bx-show" style="color:#ffff"></i></a>
                                    <a class="badge badge-center rounded-pill bg-success" title="Presentasi" style="cursor:pointer" onclick="presentasi(\'${row.id}\')"><i class="bx bx-check" style="color:#ffff"></i></a>
                                     <a class="badge badge-center rounded-pill bg-warning"title="Revisi Kedua" href="{{ url('reviewer/last-revision/${row.id}') }}"><i class="bx bx-revision"  style="color:#ffff"></i></a>`;
                            } else if (row.statuses.id === 'S03') {
                                html +=
                                    `<a class="badge badge-center rounded-pill bg-warning" title="Show" href="{{ url('reviewer/show/${row.id}') }}"><i class="bx bx-show" style="color:#ffff"></i></a>`;
                            } else
