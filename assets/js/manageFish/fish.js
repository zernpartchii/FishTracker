var fishDataSet = [
    ['FISH-001', '2025/09/10', 'Fighting Fish', 'Betta'],
    ['FISH-002', '2025/09/11', 'Molly', 'Livebearer'],
    ['FISH-003', '2025/09/12', 'Goldfish', 'Carp'],
    ['FISH-004', '2025/09/13', 'Guppy', 'Livebearer'],
    ['FISH-005', '2025/09/14', 'Oscar', 'Cichlid'],
    ['FISH-006', '2025/09/14', 'Platy', 'Livebearer'],
    ['FISH-007', '2025/09/15', 'Koi', 'Carp'],
    ['FISH-008', '2025/09/15', 'Swordtail', 'Livebearer'],
    ['FISH-009', '2025/09/16', 'Tilapia', 'Cichlid'],
    ['FISH-010', '2025/09/16', 'Angelfish', 'Cichlid']
];

new DataTable('#tableFish', {
    columns: [
        { title: 'FishID' },
        { title: 'Date Registered' },
        { title: 'Fish Name' },
        { title: 'Type' }
    ],
    data: fishDataSet,

    // ✅ Show 10, 25, 50, 100, All
    lengthMenu: [
        [10, 25, 50, 100, -1],
        [10, 25, 50, 100, "All"]
    ],
});
